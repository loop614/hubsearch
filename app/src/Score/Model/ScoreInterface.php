<?php declare(strict_types = 1);

namespace App\Score\Model;

use App\Score\ScoreData;

interface ScoreInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return ScoreData $scoreData
     */
    public function getScore(ScoreData $scoreData): ScoreData;
}
