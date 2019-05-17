<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class HorseRace extends Model
{
    /**
     * @var bool
     */
    private $is_finished;

    /**
     * @param bool $is_finished
     */
    public function setIsFinished(bool $is_finished)
    {
        $this->is_finished = $is_finished;
    }

    /**
     * @return bool
     */
    public function getIsFinished(): bool
    {
        return $this->is_finished;
    }
}
