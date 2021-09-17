<?php

namespace App\Models;

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
     * 體育群組
     */
    public function sportGroups()
    {
        return $this->hasMany(SportGroup::class);
    }
}
