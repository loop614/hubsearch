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
     * @return string[]
     */
    public function fetchTexts(): array;
}
