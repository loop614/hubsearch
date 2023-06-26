<?php declare(strict_types = 1);

namespace App\HsClient\Adapter;

use App\Score\ScoreData;

interface SiteAdapterInterface
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
     * @param string $token
     *
     * @return array
     */
    public function fetchTexts(ScoreData $scoreData, string $token): array;
}
