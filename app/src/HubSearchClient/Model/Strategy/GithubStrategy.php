<?php declare(strict_types = 1);

namespace App\HubSearchClient\Model\Strategy;

use App\HubSearchClient\Transfer\HubSearchClientResponseTransfer;
use App\HubSearchClient\Model\Strategy\Exception\GithubResponseException;
use App\Score\Transfer\ScoreTransfer;

final class GithubStrategy extends SiteStrategy
{
    /**
     * @param ScoreTransfer $scoreData
     *
     * @return bool
     */
    public function isApplicable(ScoreTransfer $scoreData): bool
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
        return 'token';
        // return getenv('mygithubtoken');
    }

    /**
     * @param ScoreTransfer $scoreData
     * @param string        $token
     *
     * @return HubSearchClientResponseTransfer
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @throws GithubResponseException
     */
    public function fetchData(ScoreTransfer $scoreData, string $token): HubSearchClientResponseTransfer
    {
        $response = new HubSearchClientResponseTransfer();
        $issues = $this->fetchIssues($scoreData, $token);
        $valid = $this->validateResponse($issues);

        if (!$valid) {
            throw new GithubResponseException();
        }

        return $this->takeTexts($response, $issues);
    }

    /**
     * @param ScoreTransfer $scoreData
     * @param string $token
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    private function fetchIssues(ScoreTransfer $scoreData, string $token): array
    {
        $url = 'https://api.github.com/search/issues?q=' . $scoreData->getTerm();
        $headers = [
            'Content-type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];

        //        $response = $this->guzzleClient->request(
        //            'GET',
        //            $url,
        //            ['headers' => $headers]
        //        );

        // return json_decode($response->getBody()->getContents(), true);
        $result = [];
        $result['items'] = [];

        for ($i = 0; $i < 10; $i++) {
            $text = [];
            $rng = rand();
            if ($rng % 3 === 0) {
                $text['body'] = 'this thing sucks';
                $text['title'] = 'this thing sucks';
                $result['items'][] = $text;
                continue;
            }
            if ($rng % 3 === 1) {
                $text['body'] = 'this thing rocks';
                $text['title'] = 'this thing rocks';
                $result['items'][] = $text;
                continue;
            }
            $text['body'] = 'lorem ipsum';
            $text['title'] = 'ipsum lorem';
            $result['items'][] = $text;
        }


        return $result;
    }

    /**
     * @param array $issues
     *
     * @return bool
     */
    private function validateResponse(array $issues): bool
    {
        return isset($issues['items']);
    }

    /**
     * @param HubSearchClientResponseTransfer $response
     * @param array $issues
     *
     * @return HubSearchClientResponseTransfer
     */
    private function takeTexts(HubSearchClientResponseTransfer $response, array $issues): HubSearchClientResponseTransfer
    {
        $texts = [];
        foreach ($issues['items'] as $item) {
            $texts[] = $item['title'] ?? '';
            $texts[] = $item['body'] ?? '';
        }
        $response->setTexts($texts);

        return $response;
    }
}
