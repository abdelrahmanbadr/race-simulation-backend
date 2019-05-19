<?php

namespace Tests\Domain\Services;

use App\Domain\Services\CalculateTimeToFinishHorseRace;
use Tests\TestCase;
use App\Domain\Repositories\EloquentHorseRepository;
use Mockery;
class CalculateTimeToFinishHorseRaceTest extends TestCase
{
    private $horseRepositoryMock;

    public function setup(): void
    {
        parent::setUp();
        $this->horseRepositoryMock = Mockery::mock(EloquentHorseRepository::class);
    }

    public function testCalculate()
    {
        $this->horseRepositoryMock->shouldReceive("getSpeed")->andReturn(5);
        $this->horseRepositoryMock->shouldReceive("getSpeedShortage")->andReturn(3);
        $this->horseRepositoryMock->shouldReceive("getEndurance")->andReturn(5);
        $service = new CalculateTimeToFinishHorseRace($this->horseRepositoryMock);
        $this->assertEquals($service->calculate(),192.86);
    }

}