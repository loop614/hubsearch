<?php declare(strict_types = 1);

namespace App\HsClient\Model\Strategy;

use App\HsClient\Carry\HsClientResponseData;
use App\Score\Carry\ScoreData;

interface SiteStrategyInterface
{
    /**
     * @return bool
     */
    public function isApplicable(ScoreData $scoreData): bool;

    /**
     * @return string
     */
    public function authenticate(): string;

    /**
     * @param ScoreData $scoreData
     * @param string    $token
     *
     * @return HsClientResponseData
     */
    public function fetchData(ScoreData $scoreData, string $token): HsClientResponseData;
}
