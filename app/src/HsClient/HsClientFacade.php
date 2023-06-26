<?php declare(strict_types = 1);

namespace App\HsClient;

use App\HsClient\Adapter\Exception\AdapterNotFoundException;
use App\Score\ScoreData;

class HsClientFacade implements HsClientFacadeInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws AdapterNotFoundException
     *
     * @return string[]
     */
    public function getTexts(ScoreData $scoreData): array
    {
        return (new HsClientFactory)
            ->createHsClient()
            ->getTexts($scoreData);
    }
}
