<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class HorseRace extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_finished', 'advances',
    ];

    /**
     * Get the horses for the race.
     */
    public function horses()
    {
        return $this->hasMany(Horse::class, "race_id");
   }

}
