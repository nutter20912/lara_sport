<?php

namespace App\Models;

use App\Models\Sport;

/**
 * 體育玩法
 */
class SportPlay extends Model
{
    /**
     * @var string
     */
    protected $table = 'sport_play';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * 體育
     */
    public function sports()
    {
        return $this->hasMany(Sport::class);
    }
}
