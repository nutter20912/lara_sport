<?php

namespace App\Models;

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
     * 體育群組
     */
    public function sportGroups()
    {
        return $this->hasMany(SportGroup::class);
    }
}
