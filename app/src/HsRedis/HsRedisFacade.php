<?php declare(strict_types = 1);

namespace App\HsRedis;

class HsRedisFacade implements HsRedisFacadeInterface
{
    /**
     * @param string $key
     *
     * @return float
     */
    public function getScoreByTerm(string $key): float
    {
        return HsRedisFactory::createHsRedis()
            ->getScoreByTerm($key);
    }

    /**
     * @param string $key
     * @param float $value
     *
     * @return void
     */
    public function setScoreByTerm(string $key, float $value): void
    {
        HsRedisFactory::createHsRedis()->setScoreByTerm($key, $value);
    }
}
