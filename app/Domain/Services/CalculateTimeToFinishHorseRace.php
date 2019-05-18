<?php

namespace App\Domain\Services;

use App\Domain\Constants\HorseRaceConstant;
use App\Domain\Repositories\EloquentHorseRepository;

class CalculateTimeToFinishHorseRace
{
    /**
     * @var EloquentHorseRepository
     */
    private $horseRepository;

    public function __construct(EloquentHorseRepository $horseRepository)
    {
        $this->horseRepository = $horseRepository;
    }

    public function calculate(): float
    {
        $bestSpeed = $this->horseRepository->getSpeed() + HorseRaceConstant::HORSE_BASE_SPEED;
        $normalSpeed = $bestSpeed - $this->horseRepository->getSpeedShortage();
        $endurance = $this->horseRepository->getEndurance() * 100;
        $timeWithBestSpeed = $endurance / $bestSpeed;
        $timeWithNormalSpeed = (HorseRaceConstant::RACE_DISTANCE - $endurance) / $normalSpeed;
        return $timeWithBestSpeed + $timeWithNormalSpeed;
    }

}