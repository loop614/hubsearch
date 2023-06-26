<?php declare(strict_types = 1);

namespace App\HsClient;

use App\Score\ScoreData;

interface HsClientFacadeInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return ScoreData
     */
    public function getScore(ScoreData $scoreData): ScoreData;
}
