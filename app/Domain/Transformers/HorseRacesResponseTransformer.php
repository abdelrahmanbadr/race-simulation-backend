<?php


namespace App\Domain\Transformers;

use App\Domain\Constants\HorseRaceConstant;
use App\Domain\Models\HorseRace;
use App\Domain\Models\Horse;
use App\Domain\Repositories\EloquentHorseRaceRepository;
use App\Domain\Repositories\EloquentHorseRepository;
use Carbon\Carbon;

/**
 * This class will be responsible for transforming the response API
 * supplied for frontend
 *
 * Class HorseRacesResponseTransformer
 * @package App\Domain\Transformers
 */
class HorseRacesResponseTransformer
{
    public function transform($races): array
    {
        if (empty($races)) {
            return [];
        }
        $racesResponse = [];
        /** @var  $raceItem HorseRace */
        foreach ($races as $raceKey => $raceItem) {
            $now = new Carbon();

            $createdAt = new Carbon($raceItem->created_at);
            $secondsPassed = $createdAt->diffInSeconds($now) + $raceItem->advances;
            $horses = [];
            $finishedHorses = [];
            /** @var  $horse Horse */
            foreach ($raceItem->horses as $key => $horse) {

                $horseRepository = new EloquentHorseRepository($horse);
                $distance = $this->calculateDistanceCovered($horseRepository, $secondsPassed);
                $horses[] = ["distanceCovered" => number_format((float)$distance, 2, '.', '')];
                if ($distance == HorseRaceConstant::RACE_DISTANCE) {
                    $finishedHorses[$key] = true;
                }

                rsort($horses);
            }

            if (count($finishedHorses) == $raceItem->horses->count()) {
                $raceItem->is_finished = true;
                $raceItem->save();
            }

            $racesResponse[] = [
                "horses" => $horses,
                "secondsPassed" => $secondsPassed
            ];
        }

        return $racesResponse;
    }

    public function calculateDistanceCovered(EloquentHorseRepository $horse, int $secondsPassed)
    {
        $bestSpeed = $horse->getSpeed() + HorseRaceConstant::HORSE_BASE_SPEED;
        $normalSpeed = $bestSpeed - $horse->getSpeedShortage();
        $endurance = $horse->getEndurance() * 100;
        $timeWithBestSpeed = $endurance / $bestSpeed;
        if ($secondsPassed <= $timeWithBestSpeed) {
            return $bestSpeed * $secondsPassed;
        }
        $distance = $endurance + $normalSpeed * ($secondsPassed - $timeWithBestSpeed);


        if ($distance >= HorseRaceConstant::RACE_DISTANCE) {
            $distance = HorseRaceConstant::RACE_DISTANCE;
        }
        return $distance;
    }
}
