<?php declare(strict_types=1);

namespace App\HubSearchRedis;

final class HubSearchRedisConfig
{
    public const SCHEME = 'tcp';
    public const HOST = 'redis_hubsearch';
    public const PORT = 6379;
    public const KEY_TTL = 60;

    public const KEY_PER_SITE = [
        'github' => 'gh',
        'twitter' => 'tw',
    ];
}

