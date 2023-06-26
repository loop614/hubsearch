<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\Score\ScoreData;

interface HsRedisFacadeInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return float
     */
    public function getScore(ScoreData $scoreData): ScoreData;

    /**
     * @param ScoreData $scoreData
     *
     * @return void
     */
    public function setScore(ScoreData $scoreData): void;
}
