<?php declare(strict_types = 1);

namespace App\HubSearchClient\Model;

use App\HubSearchClient\Model\Strategy\SiteStrategyCollection;
use App\HubSearchClient\Transfer\HubSearchClientResponseTransfer;
use App\HubSearchClient\Model\Strategy\Exception\StrategyNotFoundException;
use App\Score\Transfer\ScoreTransfer;

class HubSearchClient implements HubSearchClientInterface
{
    /**
     * @param SiteStrategyCollection $siteStrategyCollection
     */
    public function __construct(private readonly SiteStrategyCollection $siteStrategyCollection) {}

    /**
     * @param ScoreTransfer $scoreData
     *
     * @throws StrategyNotFoundException
     *
     * @return HubSearchClientResponseTransfer
     */
    public function getResponseData(ScoreTransfer $scoreData): HubSearchClientResponseTransfer
    {
        foreach ($this->siteStrategyCollection->getAll() as $strategy) {
            if ($strategy->isApplicable($scoreData)) {
                $token = $strategy->authenticate();
                return $strategy->fetchData($scoreData, $token);
            }
        }

        throw new StrategyNotFoundException();
    }
}
