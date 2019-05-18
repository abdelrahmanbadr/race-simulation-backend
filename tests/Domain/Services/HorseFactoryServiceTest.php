<?php

namespace Tests\Domain\Services;


use App\Domain\Models\Horse;
use App\Domain\Repositories\EloquentHorseRepository;
use App\Domain\Services\HorseFactoryService;
use Tests\TestCase;
use Mockery;
class HorseFactoryServiceTest extends TestCase
{
    private $horseRepositoryMock;

    public function setup(): void
    {
        parent::setUp();
        $this->horseRepositoryMock = Mockery::mock(EloquentHorseRepository::class);

    }
    //@todo add more test cases
    public function testMakeHorseObject()
    {
        $fakeHorse = new Horse();
        $fakeHorse->speed = 5;
        $fakeHorse->endurance = 5;
        $fakeHorse->strength = 5;
        $fakeHorse->speed_shortage = 3;
        $this->horseRepositoryMock->shouldReceive("save")->andReturn($fakeHorse);
        $this->horseRepositoryMock->shouldReceive("setSpeed")->with(5)->andReturn(null);
        $this->horseRepositoryMock->shouldReceive("setSpeedShortage")->with(3)->andReturn(null);
        $this->horseRepositoryMock->shouldReceive("setStrength")->with(5)->andReturn(null);
        $this->horseRepositoryMock->shouldReceive("setEndurance")->with(5)->andReturn(null);
        $this->horseRepositoryMock->shouldReceive("setRaceId")->with(1)->andReturn(null);
        $factory = new HorseFactoryService($this->horseRepositoryMock,5,5,5);
        $horse = $factory->make(1);
        $this->assertEquals($horse->speed,5);
        $this->assertEquals($horse->endurance,5);
        $this->assertEquals($horse->strength,5);
        $this->assertEquals($horse->speed_shortage,3);

    }

}