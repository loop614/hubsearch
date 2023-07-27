<?php declare(strict_types = 1);

namespace App\HubSearchRedis\Model;

use App\HubSearchRedis\Exception\SiteNotSupportedException;
use App\HubSearchRedis\HubSearchRedisConfig;
use Predis\Client as PredisClient;
use Predis\ClientInterface as PredisClientInterface;
use App\Score\Transfer\ScoreTransfer;

class HubSearchRedis implements HubSearchRedisInterface
{
    const REDIS_PREFIX = 'kv';

    private static ?PredisClientInterface $predisClient = null;

    /**
     * @param \Predis\ClientInterface $predisClient
     */
    public function __construct() 
    {
        self::$predisClient = $this->createPredisClient();
    }

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @throws \App\HubSearchRedis\Exception\SiteNotSupportedException
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreData): ScoreTransfer
    {
        if (!isset(HubSearchRedisConfig::KEY_PER_SITE[$scoreData->getSite()])) {
            throw new SiteNotSupportedException();
        }
        $score = self::$predisClient->get($this->generateKey($scoreData));

        if (is_numeric($score)) {
            $scoreData->setScore(floatval($score));
        }

        return $scoreData;
    }

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return void
     */
    public function setScore(ScoreTransfer $scoreData): void
    {
        $key = $this->generateKey($scoreData);
        $score = $scoreData->getScore();
        self::$predisClient->set($key, $score);
        self::$predisClient->expire($key, HubSearchRedisConfig::KEY_TTL);
    }

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return string
     */
    private function generateKey(ScoreTransfer $scoreData): string
    {
        return join(
            [
                self::REDIS_PREFIX,
                ':',
                HubSearchRedisConfig::KEY_PER_SITE[$scoreData->getSite()],
                ':',
                $scoreData->getTerm()
            ]
        );
    }

    /**
     * @return \Predis\Client
     */
    private function createPredisClient(): PredisClientInterface
    {
        if (self::$predisClient !== null) {
            return self::$predisClient;
        }
        self::$predisClient = new PredisClient($this->getPredisConnectionString());

        return self::$predisClient;
    }

    /**
     * @return string
     */
    private function getPredisConnectionString(): string
    {
        return HubSearchRedisConfig::SCHEME . '://' . HubSearchRedisConfig::HOST . ':' . HubSearchRedisConfig::PORT;
    }
}
