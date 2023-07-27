<?php declare(strict_types = 1);

namespace App\HubSearchClient\Model\Strategy;

use App\HubSearchClient\Transfer\HubSearchClientResponseTransfer;
use App\Score\Transfer\ScoreTransfer;

interface SiteStrategyInterface
{
    /**
     * @return bool
     */
    public function isApplicable(ScoreTransfer $scoreData): bool;

    /**
     * @return string
     */
    public function authenticate(): string;

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     * @param string $token
     *
     * @return \App\HubSearchClient\Transfer\HubSearchClientResponseTransfer
     */
    public function fetchData(ScoreTransfer $scoreData, string $token): HubSearchClientResponseTransfer;
}
