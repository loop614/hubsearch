<?php declare(strict_types = 1);

namespace App\HsRedis\Model;

interface HsRedisInterface
{
    /**
     * @param string $term
     *
     * @return float
     */
    public function getScoreByTerm(string $term): float;

    /**
     * @param string $term
     * @param float $value
     *
     * @return void
     */
    public function setScoreByTerm(string $term, float $value): void;
}
