<?php

namespace App\Domain\Entities;

/**
 * Class Horse
 * @package App\Domain\Entities
 */
class Horse
{
    /**
     * @var float
     */
    private $speed;

    /**
     * @var float
     */
    private $speedShortage;

    /**
     * @var float
     */
    private $strength;

    /**
     * @var float
     */
    private $endurance;

    /**
     * @param float $speed
     */
    public function setSpeed(float $speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return float
     */
    public function getSpeedShortage(): float
    {
        return $this->speedShortage;
    }

    /**
     * @param float $speedShortage
     */
    public function setSpeedShortage(float $speedShortage)
    {
        $this->speedShortage = $speedShortage;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @param float $strength
     */
    public function setStrength(float $strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return float
     */
    public function getStrength(): float
    {
        return $this->strength;
    }

    /**
     * @param float $endurance
     */
    public function setEndurance(float $endurance)
    {
        $this->endurance = $endurance;
    }

    /**
     * @return float
     */
    public function getEndurance(): float
    {
        return $this->endurance;
    }

}