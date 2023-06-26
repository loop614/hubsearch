<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\Score\ScoreData;

class HsRedisFacade implements HsRedisFacadeInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return ScoreData
     */
    public function getScore(ScoreData $scoreData): ScoreData
    {
        return HsRedisFactory::createHsRedis()
            ->getScore($scoreData);
    }

    /**
     * @param ScoreData $scoreData
     *
     * @return void
     */
    public function setScore(ScoreData $scoreData): void
    {
        HsRedisFactory::createHsRedis()->setScore($scoreData);
    }
}
