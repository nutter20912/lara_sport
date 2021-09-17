<?php

namespace App\Models;

use App\Models\{
    SportCategory,
    SportType,
    SportPlay
};

/**
 * 體育群組
 */
class SportGroup extends Model
{
    /**
     * @var string
     */
    protected $table = 'sport_group';

    /**
     * @var array
     */
    protected $fillable = [
        'sport_category_id',
        'sport_type_id',
        'sport_play_id',
        'enable',
    ];

    /**
     * 體育類別
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sportCategory()
    {
        return $this->belongsTo(SportCategory::class);
    }

    /**
     * 體育場別
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sportType()
    {
        return $this->belongsTo(SportType::class);
    }

    /**
     * 體育玩法
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sportPlay()
    {
        return $this->belongsTo(SportPlay::class);
    }
}
