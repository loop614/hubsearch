<?php declare(strict_types = 1);

namespace App\HubSearchClient;

use App\HubSearchClient\Transfer\HubSearchClientResponseTransfer;
use App\Score\Transfer\ScoreTransfer;

interface HubSearchClientFacadeInterface
{
    /**
     * @param ScoreTransfer $scoreData
     *
     * @return HubSearchClientResponseTransfer
     */
    public function getResponseData(ScoreTransfer $scoreData): HubSearchClientResponseTransfer;
}
