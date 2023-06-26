<?php declare(strict_types = 1);

namespace App\HsClient;

use App\HsClient\Adapter\GithubAdapter;
use App\HsClient\Adapter\SiteAdapterInterface;
use App\HsClient\Model\HsClient;
use App\HsClient\Model\HsClientInterface;
use \GuzzleHttp\Client as GuzzleHttpClient;

class HsClientFactory
{
    /**
     * @return HsClientInterface
     */
    public function createHsClient(): HsClientInterface
    {
        return new HsClient($this->createHsClientAdapters());
    }

    /**
     * @return SiteAdapterInterface[]
     */
    private function createHsClientAdapters(): array
    {
        return [
            $this->createGithubAdapter(),
        ];
    }

    /**
     * @return SiteAdapterInterface
     */
    private function createGithubAdapter(): SiteAdapterInterface
    {
        return new GithubAdapter($this->createDazzleClient());
    }

    /**
     * @return GuzzleHttpClient
     */
    private function createDazzleClient(): GuzzleHttpClient
    {
        return new GuzzleHttpClient();
    }
}
