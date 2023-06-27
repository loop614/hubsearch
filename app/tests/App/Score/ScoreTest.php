<?php declare(strict_types = 1);

namespace App\Score;

use App\HsClient\Carry\HsClientResponseData;
use App\HsClient\HsClientFacadeInterface;
use App\HsRedis\HsRedisFacadeInterface;
use App\Score\Carry\ScoreData;
use App\Score\Model\Score;
use App\Score\Model\ScoreInterface;
use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;

class UserTest extends Unit
{
    /**
     * @var HsRedisFacadeInterface|MockObject
     */
    private HsRedisFacadeInterface|MockObject $mockHsRedisFacade;

    /**
     * @var HsClientFacadeInterface|MockObject
     */
    private HsClientFacadeInterface|MockObject $mockHsClientFacade;

    /**
     * @var ScoreInterface
     */
    private ScoreInterface $sut;

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
     * @return HsRedisFacadeInterface|MockObject
     */
    private function getMochHsRedisFacade(): HsRedisFacadeInterface|MockObject
    {
        return $this->createMock(HsRedisFacadeInterface::class);
    }

    /**
     * @return HsClientFacadeInterface|MockObject
     */
    private function getMockHsClientFacade(): HsClientFacadeInterface|MockObject
    {
        return $this->createMock(HsClientFacadeInterface::class);
    }
}
