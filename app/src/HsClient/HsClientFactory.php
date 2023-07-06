<?php declare(strict_types = 1);

namespace App\HsClient;

use App\Core\CoreFactory;
use App\HsClient\Model\HsClient;
use App\HsClient\Model\HsClientInterface;
use App\HsClient\Model\Strategy\GithubStrategy;
use App\HsClient\Model\Strategy\SiteStrategyInterface;
use GuzzleHttp\Client as GuzzleHttpClient;

class HsClientFactory extends CoreFactory
{
    /**
     * @return HsClientInterface
     */
    public function createHsClient(): HsClientInterface
    {
        return new HsClient($this->createHsClientStrategys());
    }

    /**
     * @return SiteStrategyInterface[]
     */
    private function createHsClientStrategys(): array
    {
        return [
            $this->createGithubStrategy(),
        ];
    }

    /**
     * @return SiteStrategyInterface
     */
    private function createGithubStrategy(): SiteStrategyInterface
    {
        return new GithubStrategy($this->createDazzleClient());
    }

    /**
     * @return GuzzleHttpClient
     */
    private function createDazzleClient(): GuzzleHttpClient
    {
        return new GuzzleHttpClient();
    }
}
