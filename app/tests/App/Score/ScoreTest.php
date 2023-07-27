<?php declare(strict_types = 1);

namespace App\Score;

use App\HsClient\Carry\HsClientResponseData;
use App\HsClient\HubSearchClientFacadeInterface;
use App\HsRedis\HubSearchRedisFacadeInterface;
use App\Score\Carry\ScoreData;
use App\Score\Model\Score;
use App\Score\Model\ScoreInterface;
use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;

class UserTest extends Unit
{
    /**
     * @var \App\HsRedis\HubSearchRedisFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private HubSearchRedisFacadeInterface|MockObject $mockHsRedisFacade;

    /**
     * @var \App\HsClient\HubSearchClientFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private HubSearchClientFacadeInterface|MockObject $mockHsClientFacade;

    /**
     * @var \App\Score\Model\ScoreInterface
     */
    private ScoreInterface $sut;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();
        $this->mockHsRedisFacade = $this->getMochHsRedisFacade();
        $this->mockHsClientFacade = $this->getMockHsClientFacade();

        $this->sut = new Score(
            $this->mockHsRedisFacade,
            $this->mockHsClientFacade,
        );
    }

    /**
     * @return void
     */
    public function testScoreCalculator()
    {
        $emptyRedisScoreData = new ScoreData('Github', 'php');
        $clientResponse = new HsClientResponseData();
        $texts = ['everybody sucks at something', 'everybody rocks at something'];
        $clientResponse->setTexts($texts);
        $expectedScore = 5;

        $this->mockHsRedisFacade
            ->expects($this->once())
            ->method('hydrateScore')
            ->willReturn($emptyRedisScoreData);

        $this->mockHsClientFacade
            ->expects($this->once())
            ->method('getResponseData')
            ->willReturn($clientResponse);

        $inputScoreData = new ScoreData('Github', 'php');
        $outputScoreData = $this->sut->hydrateScore($inputScoreData);
        $this->assertEquals($outputScoreData->getScore(), $expectedScore);
    }

    /**
     * @return \App\HsRedis\HubSearchRedisFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private function getMochHsRedisFacade(): HubSearchRedisFacadeInterface|MockObject
    {
        return $this->createMock(HubSearchRedisFacadeInterface::class);
    }

    /**
     * @return \App\HsClient\HubSearchClientFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private function getMockHsClientFacade(): HubSearchClientFacadeInterface|MockObject
    {
        return $this->createMock(HubSearchClientFacadeInterface::class);
    }
}
