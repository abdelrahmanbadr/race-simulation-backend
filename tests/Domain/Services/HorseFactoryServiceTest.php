<?php

namespace Tests\Domain\Services;


use App\Domain\Services\HorseFactoryService;
use Tests\TestCase;

class HorseFactoryServiceTest extends TestCase
{
    //@todo add more test cases
    public function testMakeHorseObject()
    {
        $factory = new HorseFactoryService(5,5,5);
        $horse = $factory->make();
        $this->assertEquals($horse->getSpeed(),5);
        $this->assertEquals($horse->getEndurance(),5);
        $this->assertEquals($horse->getStrength(),5);
        $this->assertEquals($horse->getSpeedShortage(),3);
    }

}