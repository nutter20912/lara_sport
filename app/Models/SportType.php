<?php

namespace App\Models;

use App\Models\Sport;

/**
 * 體育場別
 */
class SportType extends Model
{
    /**
     * @var string
     */
    protected $table = 'sport_type';

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
