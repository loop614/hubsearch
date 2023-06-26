<?php declare(strict_types = 1);

namespace App\HsClient\Model;

interface HsClientInterface
{
    /**
     * @param string $term
     *
     * @return float
     */
    public function getScoreForTerm(string $term): float;
}
