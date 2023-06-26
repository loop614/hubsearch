<?php declare(strict_types = 1);

namespace App\HsClient;

use App\HsClient\Model\HsClient;
use App\HsClient\Model\HsClientInterface;
use \GuzzleHttp\Client as GuzzleHttpClient;

class HsClientFactory
{
    /**
     * @return HsClientInterface
     */
    public static function createHsClient(): HsClientInterface
    {
        return new HsClient(self::createDazzleClient());
    }

    /**
     * @return GuzzleHttpClient
     */
    private static function createDazzleClient()
    {
        return new GuzzleHttpClient();
    }
}
