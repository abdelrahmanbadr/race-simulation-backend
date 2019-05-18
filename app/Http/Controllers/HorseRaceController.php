<?php

namespace App\Http\Controllers;

use App\Domain\Constants\HorseRaceConstant;
use App\Domain\Models\Horse;
use App\Domain\Models\HorseRace;
use App\Domain\Repositories\EloquentHorseRaceRepository;
use App\Domain\Repositories\EloquentHorseRepository;
use App\Domain\Services\CalculateTimeToFinishHorseRace;
use App\Domain\Services\HorseFactoryService;
use App\Domain\Transformers\HorseRacesResponseTransformer;


class HorseRaceController extends Controller
{
    public function getBestResults()
    {
        $horseRepository = new EloquentHorseRepository(new Horse());
        $horses = $horseRepository->getEmptyTimeToFinishRecords();
        foreach ($horses as $horseItem) {
            $repository = new EloquentHorseRepository($horseItem);
            $time = (new CalculateTimeToFinishHorseRace($repository))->calculate();
            $repository->setTimeToFinish($time);
            $repository->save();
        }

        $bestTimeEver = $horseRepository->getBestTimeEverHorse();
        $raceRepository = new EloquentHorseRaceRepository(new HorseRace());
        $bestResultsForLastFiveRaces = $raceRepository->getBestThreeResultForEachLastFiveRaces();

        return ["bestResultEver" => $bestTimeEver, "bestResultsForLastFiveRaces" => $bestResultsForLastFiveRaces];
    }

    public function createRace()
    {
        $raceRepository = new EloquentHorseRaceRepository(new HorseRace());
        if ($raceRepository->getActiveRaces()->count() >= 3){
            return;
        }
        $race = $raceRepository->save();
        for ($i = 0; $i < HorseRaceConstant::RACE_HORSES_NUMBER; $i++) {
            $horseRepository = new EloquentHorseRepository(new Horse());
            (new HorseFactoryService($horseRepository))->make($race->id);
        }
    }

    public function advanceActiveRaces()
    {
        $raceRepository = new EloquentHorseRaceRepository(new HorseRace());
        $races = $raceRepository->getActiveRaces();
        foreach ($races as $raceItem) {
            $horseRepository = new EloquentHorseRaceRepository($raceItem);
            $advances = $horseRepository->getAdvances() + HorseRaceConstant::RACE_ADVANCED_SECONDS;
            $horseRepository->setAdvances($advances);
            $horseRepository->save();
        }
    }

    public function getActiveRaces()
    {
        $repository = new EloquentHorseRaceRepository(new HorseRace());
        $races = $repository->getActiveRacesWithHorses();
        $transformer = new HorseRacesResponseTransformer();
        return $transformer->transform($races);
    }
}
