<?php declare(strict_types = 1);

namespace App\HsRedis\Model;

use App\HsRedis\Exception\SiteNotSupportedException;
use App\HsRedis\HsRedisConfig;
use Predis\Client as PredisClient;
use App\Score\Carry\ScoreData;

class HsRedis implements HsRedisInterface
{
    /**
     * @var \Predis\Client
     */
    private PredisClient $predisClient;

    const REDIS_PREFIX = 'kv';

    /**
     * @param \Predis\Client $redisClient
     */
    public function __construct(PredisClient $redisClient)
    {
        $this->predisClient = $redisClient;
    }

    /**
     * @param \App\Score\Carry\ScoreData $scoreData
     *
     * @throws \App\HsRedis\Exception\SiteNotSupportedException
     *
     * @return \App\Score\Carry\ScoreData
     */
    public function hydrateScore(ScoreData $scoreData): ScoreData
    {
        if (!isset(HsRedisConfig::KEY_PER_SITE[$scoreData->getSite()])) {
            throw new SiteNotSupportedException();
        }
        $score = $this->predisClient->get($this->generateKey($scoreData));

        if (is_numeric($score)) {
            $scoreData->setScore(floatval($score));
        }

        return $scoreData;
    }

    /**
     * @param \App\Score\Carry\ScoreData $scoreData
     *
     * @return void
     */
    public function setScore(ScoreData $scoreData): void
    {
        $key = $this->generateKey($scoreData);
        $score = $scoreData->getScore();
        $this->predisClient->set($key, $score);
        $this->predisClient->expire($key, HsRedisConfig::KEY_TTL);
    }

    /**
     * @param \App\Score\Carry\ScoreData $scoreData
     *
     * @return string
     */
    private function generateKey(ScoreData $scoreData): string
    {
        return join(
            [
                self::REDIS_PREFIX,
                ':',
                HsRedisConfig::KEY_PER_SITE[$scoreData->getSite()],
                ':',
                $scoreData->getTerm()
            ]
        );
    }
}
