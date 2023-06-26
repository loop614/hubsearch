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
    public static function createHsRedis(): HsRedisInterface
    {
        return new HsRedis(self::createPredisClient());
    }

    /**
     * @return PredisClient
     */
    public static function createPredisClient(): PredisClient
    {
        return new PredisClient([
            'scheme' => getenv('redis_scheme'),
            'host'   => getenv('redis_host'),
            'port'   => getenv('redis_port'),
        ]);
    }
}
