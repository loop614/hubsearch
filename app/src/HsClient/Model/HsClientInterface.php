<?php declare(strict_types = 1);

namespace App\HsClient\Model;

use App\Score\ScoreData;

interface HsClientInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return ScoreData
     */
    public function getScore(ScoreData $scoreData): ScoreData;
}
