<?php

namespace App\Models;

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

    public function toArray()
    {
        return [
            'id' => $this->id,
            'sport_category_id' => $this->sportCategory->id,
            'sport_category_name' => $this->sportCategory->name,
            'sport_type_id' => $this->sportType->id,
            'sport_type_name' => $this->sportType->name,
            'sport_play_id' => $this->sportPlay->id,
            'sport_play_name' => $this->sportPlay->name,
            'enable' => $this->enable,
        ];
    }
}
