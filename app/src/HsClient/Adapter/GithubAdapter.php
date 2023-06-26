<?php declare(strict_types = 1);

namespace App\HsClient\Adapter;

use App\HsClient\Adapter\Exception\GithubResponseException;
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
        return $scoreData->getSite() === 'github';
    }

    /**
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authenticate(): string
    {
        return getenv('mygithubtoken');
//        if (self::$baererToken != '') {
//            return self::$baererToken;
//        }
//
//        $response = $this->guzzleClient->get(
//            getenv('github_auth_path')
//        );
//
//        return self::$baererToken;
    }

    /**
     * @param ScoreData $scoreData
     * @param string $token
     *
     * @throws GithubResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    public function fetchTexts(ScoreData $scoreData, string $token): array
    {
        $issues = $this->fetchIssues($scoreData, $token);
        $valid = $this->validateResponse($issues);

        if (!$valid) {
            throw new GithubResponseException();
        }

        return $this->takeTexts($issues);
    }

    /**
     * @param ScoreData $scoreData
     * @param string $token
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    private function fetchIssues(ScoreData $scoreData, string $token): array
    {
        $url = 'https://api.github.com/search/issues?q=' . $scoreData->getTerm();
        $headers = [
            'Content-type'  => 'application/json; charset=utf-8',
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];

        $response = $this->guzzleClient->request(
            'GET',
            $url,
            ['headers' => $headers]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $issues
     *
     * @return bool
     */
    private function validateResponse(array $issues): bool
    {
        return isset($issues['items']) && count($issues['items']) > 1;
    }

    /**
     * @param array $issues
     *
     * @return array
     */
    private function takeTexts(array $issues): array
    {
        $texts = [];
        foreach ($issues['items'] as $item) {
            $texts[] = $item['title'];
            $texts[] = $item['body'];
        }

        return $texts;
    }
}
