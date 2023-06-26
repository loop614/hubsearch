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
    public function hydrateScore(ScoreData $scoreData): ScoreData
    {
        return (new HsRedisFactory())
            ->createHsRedis()
            ->hydrateScore($scoreData);
    }

    /**
     * @param ScoreData $scoreData
     *
     * @return void
     */
    public function setScore(ScoreData $scoreData): void
    {
        (new HsRedisFactory())
            ->createHsRedis()
            ->setScore($scoreData);
    }
}
