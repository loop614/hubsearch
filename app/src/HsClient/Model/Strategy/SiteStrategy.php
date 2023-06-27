<?php declare(strict_types = 1);

namespace App\HsClient\Model\Strategy;

use GuzzleHttp\Client as GuzzleClient;

abstract class SiteStrategy implements SiteStrategyInterface
{
    protected static $baererToken = '';

    /**
     * @var GuzzleClient
     */
    protected GuzzleClient $guzzleClient;

    /**
     * @param GuzzleClient $guzzleClient
     */
    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }
}
