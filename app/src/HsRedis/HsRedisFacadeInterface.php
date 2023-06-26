<?php declare(strict_types = 1);

namespace App\HsRedis;

interface HsRedisFacadeInterface
{
    /**
     * @param string $key
     *
     * @return float
     */
    public function getScoreByTerm(string $key): float;

    /**
     * @param string $key
     * @param float $value
     *
     * @return void
     */
    public function setScoreByTerm(string $key, float $value): void;
}
