<?php

namespace App\Domain\Services;

use App\Domain\Models\Horse;
use App\Domain\Constants\HorseRaceConstant;
use App\Domain\Repositories\EloquentHorseRepository;

/**
 * This class will be responsible for making object of Horse model with random stats
 *
 * Class HorseFactoryService
 * @package App\Domain\Services
 */
class HorseFactoryService
{
    /**
     * @var EloquentHorseRepository
     */
    private $horseRepository;

    /**
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
     * @param EloquentHorseRepository $horseRepository
     * @param int|null $speed
     * @param int|null $strength
     * @param int|null $endurance
     */
    public function __construct(EloquentHorseRepository $horseRepository,int $speed = null, int $strength = null, int $endurance = null)
    {
        $this->horseRepository = $horseRepository;
        $this->speed = ($speed ?? $this->getRandomStat());
        $this->strength = $strength ?? $this->getRandomStat();
        $this->endurance = ($endurance ?? $this->getRandomStat());
        $this->speedShortage = $this->calculateSpeedShortage();
    }

    /**
     * @param int $raceId
     * @return Horse
     */
    public function make(int $raceId): Horse
    {

        $this->horseRepository->setSpeed($this->speed);
        $this->horseRepository->setSpeedShortage($this->speedShortage);
        $this->horseRepository->setStrength($this->strength);
        $this->horseRepository->setEndurance($this->endurance);
        $this->horseRepository->setRaceId($raceId);

        return $this->horseRepository->save();
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