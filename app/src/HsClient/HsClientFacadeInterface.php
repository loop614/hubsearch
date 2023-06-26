<?php declare(strict_types = 1);

namespace App\HsClient;

interface HsClientFacadeInterface
{
    /**
     * @param string $term
     * @return float
     */
    public function getScoreForTerm(string $term): float;
}
