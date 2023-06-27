<?php declare(strict_types = 1);

namespace App\HsRedis\Model;

use App\Score\Carry\ScoreData;

interface HsRedisInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return ScoreData
     */
    public function hydrateScore(ScoreData $scoreData): ScoreData;

    /**
     * @param ScoreData $scoreData
     *
     * @return void
     */
    public function setScore(ScoreData $scoreData): void;
}
