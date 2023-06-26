<?php declare(strict_types = 1);

namespace App\Score\Model;

interface ScoreInterface
{
    /**
     * @param string $term
     *
     * @return float
     */
    public function getKeyByTerm(string $term): float;
}
