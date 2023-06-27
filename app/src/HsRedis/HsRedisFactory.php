<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\HsRedis\Model\HsRedis;
use App\HsRedis\Model\HsRedisInterface;
use Predis\Client as PredisClient;

class HsRedisFactory
{
    /**
     * @return HsRedisInterface
     */
    public function createHsRedis(): HsRedisInterface
    {
        return new HsRedis(self::createPredisClient());
    }

    /**
     * @return PredisClient
     */
    public function createPredisClient(): PredisClient
    {
        return new PredisClient($this->getPredisConnectionString());
    }

    /**
     * @return string
     */
    public function getPredisConnectionString(): string
    {
        return HsRedisConfig::SCHEME . '://' . HsRedisConfig::HOST . ':' . HsRedisConfig::PORT;
    }
}
