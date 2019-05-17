<?php

namespace App\Domain\Services;

use App\Domain\Entities\Horse;
use App\Domain\Constants\HorseRaceConstant;

/**
 * This class will be responsible for making object of Horse model with random stats
 *
 * Class HorseFactoryService
 * @package App\Domain\Services
 */
class HorseFactoryService
{
    /**
     * Speed formula HORSE_BASE_SPEED + random speed stat
     * after $endurance value is passed from the race jockey slows the horse down by JOCKEY_SLOW_DOWN_EFFECT
     * but effect reduced by ($strength * 8/100)
     *
     * Unit is meters/seconds
     *
     * @var float
     */
    private $speed;

    /**
     *
     * @var float
     */
    private $strength;

    /**
     * Represent how many hundreds of meters horse can run with best speed
     * before jockey weight slows the horse down
     *
     * Unit is hundreds of meters
     *
     * @var float
     */
    private $endurance;

    /**
     * How many units will be reduced from horse speed after endurance distance is passed
     *
     * Unit is meters/seconds
     *
     * @var float
     */
    private $speedShortage;


    /**
     * HorseFactoryService constructor.
     * @param int $speed
     * @param int $strength
     * @param int $endurance
     */
    public function __construct(int $speed = null, int $strength = null, int $endurance = null)
    {
        $this->speed = ($speed ?? $this->getRandomStat());
        $this->strength = $strength ?? $this->getRandomStat();
        $this->endurance = ($endurance ?? $this->getRandomStat());
        $this->speedShortage = $this->calculateSpeedShortage();
    }

    /**
     * @return Horse
     */
    public function make(): Horse
    {
        $horse = new Horse();
        $horse->setSpeed($this->speed);
        $horse->setSpeedShortage($this->speedShortage);
        $horse->setStrength($this->strength);
        $horse->setEndurance($this->endurance);


        return $horse;
    }

    /**
     * Generate random stat from 0.0 to 10.0
     *
     * @return float
     */
    private function getRandomStat(): float
    {
        return mt_rand(0, 100) / 10;
    }

    /**
     * @return float
     */
    private function calculateSpeedShortage(): float
    {
        $reduceEffect = ($this->strength * 8) * HorseRaceConstant::JOCKEY_SLOW_DOWN_EFFECT / 100;
        return HorseRaceConstant::JOCKEY_SLOW_DOWN_EFFECT - $reduceEffect;
    }

}