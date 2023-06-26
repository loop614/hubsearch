<?php declare(strict_types = 1);

namespace App\HsClient\Adapter;

use App\Score\ScoreData;

class GithubAdapter extends SiteAdapter
{
    /**
     * @param ScoreData $scoreData
     *
     * @return bool
     */
    public function isApplicable(ScoreData $scoreData): bool
    {
        return $scoreData->getSite() === 'Github';
    }

    /**
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authenticate(): string
    {
        if (self::$baererToken != '') {
            return self::$baererToken;
        }
        $response = $this->guzzleClient->get(
            getenv('github_auth_path')
        );
        $baererToken = '';

        return self::$baererToken;
    }

    /**
     * @return array|string[]
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchTexts(): array
    {
        $texts = [];
        // get dazzle get my values
        $response = $this->guzzleClient->get(getenv('github_resource_path'));
        $responseBody = $response->getBody();

        return [];
    }
}
