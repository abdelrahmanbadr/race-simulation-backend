<?php

namespace App\Domain\Repositories;


class EloquentHorseRepository extends BaseEloquentRepository
{

    public function getEmptyTimeToFinishRecords()
    {
        return $this->entity->where("time_to_finish", null)->get();
    }

    public function getBestTimeEverHorse()
    {
        return $this->entity->whereHas("race", function ($q) {
            $q->where("is_finished", 1);
        })->where('time_to_finish', '!=', null)->orderBy('time_to_finish')->first();
    }

    public function getBestResultsWithinRace(int $raceId, int $recordsNumber)
    {
        return $this->entity->where('time_to_finish', '!=', null)
            ->where("race_id", $raceId)
            ->orderBy('time_to_finish')->limit($recordsNumber)->get();
    }

    /**
     * @param float $speed
     */
    public function setSpeed(float $speed)
    {
        $this->entity->speed = $speed;
    }

    /**
     * @return float
     */
    public function getSpeedShortage(): float
    {
        return $this->entity->speed_shortage;
    }

    /**
     * @param float $speedShortage
     */
    public function setSpeedShortage(float $speedShortage)
    {
        $this->entity->speed_shortage = $speedShortage;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->entity->speed;
    }

    /**
     * @param float $strength
     */
    public function setStrength(float $strength)
    {
        $this->entity->strength = $strength;
    }

    /**
     * @return float
     */
    public function getStrength(): float
    {
        return $this->entity->strength;
    }

    /**
     * @param float $endurance
     */
    public function setEndurance(float $endurance)
    {
        $this->entity->endurance = $endurance;
    }

    /**
     * @return float
     */
    public function getEndurance(): float
    {
        return $this->entity->endurance;
    }

    /**
     * @param int $raceid
     */
    public function setRaceId(int $raceid)
    {
        $this->entity->race_id = $raceid;
    }

    /**
     * @return int
     */
    public function getRaceId(): int
    {
        return $this->entity->race_id;
    }

    /**
     * @param float $timeToFinish
     */
    public function setTimeToFinish(float $timeToFinish)
    {
        $this->entity->time_to_finish = $timeToFinish;
    }

    /**
     * @return float
     */
    public function getTimeToFinish(): float
    {
        return $this->entity->time_to_finish;
    }

}