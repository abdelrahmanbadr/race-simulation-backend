<?php


namespace App\Domain\Constants;


class HorseRaceConstant
{
    /**
     * Unit is meters/seconds
     */
    public const HORSE_BASE_SPEED = 5;

    /**
     * The race full distance
     *
     * Unit is meters
     */
    public const RACE_DISTANCE = 1500;

    /**
     * Jockey slow down effect after $endurance value is passed from the race
     *
     * Unit is meters/seconds
     */
    public const JOCKEY_SLOW_DOWN_EFFECT = 5;

    /**
     * horses number in each race
     */
    public const RACE_HORSES_NUMBER = 8;

    /**
     * Max number of concurrent races
     */
    public const MAX_CONCURRENT_RACES = 3;

    /**
     * seconds for each race advance
     */
    public const RACE_ADVANCED_SECONDS = 10;


}