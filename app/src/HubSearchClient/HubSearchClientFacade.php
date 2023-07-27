<?php declare(strict_types = 1);

namespace App\HubSearchClient;

use App\HubSearchClient\Model\HubSearchClientInterface;
use App\HubSearchClient\Transfer\HubSearchClientResponseTransfer;
use App\HubSearchClient\Model\Strategy\Exception\StrategyNotFoundException;
use App\Score\Transfer\ScoreTransfer;

final class HubSearchClientFacade implements HubSearchClientFacadeInterface
{
    /**
     * @param \App\HubSearchClient\Model\HubSearchClientInterface $HubSearchClient
     */
    public function __construct(private readonly HubSearchClientInterface $HubSearchClient) {}

    /**
     * @param ScoreTransfer $scoreData
     *
     * @return HubSearchClientResponseTransfer
     *@throws StrategyNotFoundException
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getResponseData(ScoreTransfer $scoreData): HubSearchClientResponseTransfer
    {
        return $this->HubSearchClient->getResponseData($scoreData);
    }
}
