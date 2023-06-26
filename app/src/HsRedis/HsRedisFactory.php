<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\HsRedis\Model\HsRedis;
use App\HsRedis\Model\HsRedisInterface;
use Predis\Client as PredisClient;

class HsRedisFactory
{
    public static function createHsRedis(): HsRedisInterface
    {
        return new HsRedis(self::createPredisClient());
    }

    public static function createPredisClient(): PredisClient
    {
        return new PredisClient([
            'scheme' => 'tcp',
            'host'   => 'redis_hubsearch',
            'port'   => 6379,
        ]);
    }
}
