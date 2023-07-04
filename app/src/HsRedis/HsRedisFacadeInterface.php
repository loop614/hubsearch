<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\Score\Carry\ScoreData;

interface HsRedisFacadeInterface
{
    /**
     * @param \App\Score\Carry\ScoreData $scoreData
     *
     * @return \App\Score\Carry\ScoreData
     */
    public function hydrateScore(ScoreData $scoreData): ScoreData;

    /**
     * @param \App\Score\Carry\ScoreData $scoreData
     *
     * @return void
     */
    public function setScore(ScoreData $scoreData): void;
}
