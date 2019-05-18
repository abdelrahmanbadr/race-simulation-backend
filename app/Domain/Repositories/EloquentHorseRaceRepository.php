<?php


namespace App\Domain\Repositories;


class EloquentHorseRaceRepository extends BaseEloquentRepository
{
    //@todo benchmark this function and reach a better solution
    public function getBestThreeResultForEachLastFiveRaces()
    {
        $races = $this->entity::where("is_finished", 1)->orderBy("id", "desc")->limit(5)->get();
        $results = [];
        foreach ($races as $raceItem) {
            $respository = new static($raceItem);
            $results[] = $respository->getBestThreeResults($raceItem->id);
        }
        return $results;

    }

    public function getBestThreeResults($raceId)
    {
        return $this->entity::where("id", $raceId)->with(["horses" => function ($q) {
            $q->orderBy('time_to_finish')->limit(3)->get();
        }])->orderBy("id", "desc")->first();
    }

    public function getActiveRaces()
    {
        return $this->entity::where("is_finished", 0)->get();
    }

    public function getActiveRacesWithHorses()
    {
        return $this->entity::where("is_finished", 0)->with("horses")->get();
    }

    private function activeRaces()
    {
        return $this->entity::where("is_finished", 0);
    }

    /**
     * @param boolean $isFinished
     */
    public function setIsFinished(bool $isFinished)
    {
        $this->entity->is_finished = $isFinished;
    }

    /**
     * @return bool
     */
    public function getSpeed(): bool
    {
        return $this->entity->is_finished;
    }

    /**
     * @param int $advances
     */
    public function setAdvances(int $advances)
    {
        $this->entity->advances = $advances;
    }

    /**
     * @return int
     */
    public function getAdvances(): int
    {
        return $this->entity->advances;
    }


}