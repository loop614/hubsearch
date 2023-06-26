<?php declare(strict_types = 1);

namespace App\HsClient;

use App\Score\ScoreData;

interface HsClientFacadeInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return string[]
     */
    public function getTexts(ScoreData $scoreData): array;
}
