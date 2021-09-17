<?php

namespace App\Models;

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
     * 體育群組
     */
    public function sportGroups()
    {
        return $this->hasMany(SportGroup::class);
    }
}
