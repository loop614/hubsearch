<?php declare(strict_types = 1);

namespace App\HsClient\Model;

use App\HsClient\Carry\HsClientResponseData;
use App\Score\Carry\ScoreData;

interface HsClientInterface
{
    /**
     * @param ScoreData $scoreData
     *
     * @return HsClientResponseData
     */
    public function getResponseData(ScoreData $scoreData): HsClientResponseData;
}
