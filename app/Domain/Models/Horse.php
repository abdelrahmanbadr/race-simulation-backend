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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'speed', 'strength','endurance','speed_shortage','time_to_finish','race_id',
    ];

}