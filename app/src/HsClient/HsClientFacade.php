<?php declare(strict_types = 1);

namespace App\HsClient;

use App\Score\ScoreData;

class HsClientFacade implements HsClientFacadeInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return ScoreData
     */
    public function getScore(ScoreData $scoreData): ScoreData
    {
        return HsClientFactory::createHsClient()
            ->getScore($scoreData);
    }
}
