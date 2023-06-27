<?php declare(strict_types = 1);

namespace App\HsClient;

use App\HsClient\Carry\HsClientResponseData;
use App\Score\Carry\ScoreData;

interface HsClientFacadeInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return HsClientResponseData
     */
    public function getResponseData(ScoreData $scoreData): HsClientResponseData;
}
