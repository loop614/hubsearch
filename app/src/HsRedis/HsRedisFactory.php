<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\HsRedis\Model\HsRedis;
use App\HsRedis\Model\HsRedisInterface;
use Predis\Client as PredisClient;

class HsRedisFactory
{
    private static ?PredisClient $predisClient = NULL;

    /**
     * @return \App\HsRedis\Model\HsRedisInterface
     */
    public function createHsRedis(): HsRedisInterface
    {
        return new HsRedis(self::createPredisClient());
    }

    /**
     * @return \Predis\Client
     */
    public function createPredisClient(): PredisClient
    {
        if (self::$predisClient !== null) {
            return self::$predisClient;
        }
        self::$predisClient = new PredisClient($this->getPredisConnectionString());

        return self::$predisClient;
    }

    /**
     * @return string
     */
    public function getPredisConnectionString(): string
    {
        return HsRedisConfig::SCHEME . '://' . HsRedisConfig::HOST . ':' . HsRedisConfig::PORT;
    }
}
