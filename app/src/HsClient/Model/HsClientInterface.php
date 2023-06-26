<?php declare(strict_types = 1);

namespace App\HsClient\Model;

use App\Score\ScoreData;

interface HsClientInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return string[]
     *
     */
    public function getTexts(ScoreData $scoreData): array;
}
