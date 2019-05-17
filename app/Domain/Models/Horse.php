<?php

namespace App\Domain\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Horse
 * @package App\Domain\Models
 */
class Horse extends Model
{
    /**
     * @var float
     */
    private $speed;

    /**
     * @var float
     */
    private $speed_shortage;

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
        return $this->speed_shortage;
    }

    /**
     * @param float $speedShortage
     */
    public function setSpeedShortage(float $speedShortage)
    {
        $this->speed_shortage = $speedShortage;
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