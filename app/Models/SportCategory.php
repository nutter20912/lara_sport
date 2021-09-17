<?php

namespace App\Models;

use App\Models\Sport;

/**
 * 體育類別
 */
class SportCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'sport_category';

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
