<?php declare(strict_types = 1);

namespace App\HsClient\Model\Strategy;

use App\HsClient\Transfer\HsClientResponseTransfer;
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
     * @param ScoreTransfer $scoreData
     * @param string        $token
     *
     * @return HsClientResponseTransfer
     */
    public function fetchData(ScoreTransfer $scoreData, string $token): HsClientResponseTransfer;
}
