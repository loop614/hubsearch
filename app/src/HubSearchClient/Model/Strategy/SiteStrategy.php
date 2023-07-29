<?php declare(strict_types = 1);

namespace App\HubSearchClient\Model\Strategy;

use GuzzleHttp\Client as GuzzleClient;

abstract class SiteStrategy implements SiteStrategyInterface
{
    protected static $baererToken = '';

    public function __construct(protected readonly GuzzleClient $guzzleClient) {}
}
