<?php declare(strict_types = 1);

namespace App\HsClient;

use App\HsClient\Carry\HsClientResponseData;
use App\HsClient\Model\Strategy\Exception\StrategyNotFoundException;
use App\Score\Carry\ScoreData;

class HsClientFacade implements HsClientFacadeInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws StrategyNotFoundException
     *
     * @return HsClientResponseData
     */
    public function getResponseData(ScoreData $scoreData): HsClientResponseData
    {
        return (new HsClientFactory)
            ->createHsClient()
            ->getResponseData($scoreData);
    }
}
