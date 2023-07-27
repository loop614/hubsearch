<?php declare(strict_types = 1);

namespace App\HubSearchClient\Model\Strategy;

use GuzzleHttp\Client as GuzzleClient;

abstract class SiteStrategy implements SiteStrategyInterface
{
    protected static $baererToken = '';

    /**
     * @var \GuzzleHttp\Client
     */
    protected GuzzleClient $guzzleClient;

    public function __construct()
    {
        $this->guzzleClient = new GuzzleClient();;
    }
}
