<?php declare(strict_types = 1);

namespace App\Score\Model;

use App\Score\Carry\ScoreData;

interface ScoreInterface
{
    /**
     * @param \App\Score\Carry\ScoreData $scoreData
     *
     * @return \App\Score\Carry\ScoreData
     */
    public function hydrateScore(ScoreData $scoreData): ScoreData;
}
