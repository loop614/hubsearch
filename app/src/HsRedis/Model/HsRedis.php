<?php declare(strict_types = 1);

namespace App\HsRedis\Model;

use App\HsRedis\HsRedisConfig;
use App\Score\ScoreData;
use Predis\Client as PredisClient;

class HsRedis implements HsRedisInterface
{
    /**
     * @var PredisClient
     */
    private PredisClient $predisClient;

    const REDIS_PREFIX = 'kv';

    /**
     * @param PredisClient $redisClient
     */
    public function __construct(PredisClient $redisClient)
    {
        $this->predisClient = $redisClient;
    }

    /**
     * @param ScoreData $scoreData
     *
     * @return ScoreData
     */
    public function getScore(ScoreData $scoreData): ScoreData
    {
        assert(is_array($scoreData->getSite()), HsRedisConfig::KEY_PER_SITE);

        $score = $this->predisClient->getKey($this->generateKey($scoreData));
        $scoreData->setScore($score);

        return $scoreData;
    }

    /**
     * @param ScoreData $scoreData
     *
     * @return void
     */
    public function setScore(ScoreData $scoreData): void
    {
        $this->predisClient->set($this->generateKey($scoreData), $scoreData->getScore());
    }

    /**
     * @param ScoreData $scoreData
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
