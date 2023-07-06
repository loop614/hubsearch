<?php declare(strict_types = 1);

namespace App\HsClient;

use App\HsClient\Transfer\HsClientResponseTransfer;
use App\Score\Transfer\ScoreTransfer;

interface HsClientFacadeInterface
{
    /**
     * @param ScoreTransfer $scoreData
     *
     * @return HsClientResponseTransfer
     */
    public function getResponseData(ScoreTransfer $scoreData): HsClientResponseTransfer;
}
