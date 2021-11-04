<?php

namespace App\Models;

use App\Models\Concerns\HasBigInteger;

class GameStatus extends Model
{
    /**
     * @var string
     */
    protected $table = 'game_status';

    /**
     * @var array
     */
    protected $fillable = [
        'sport_group_id',
        'game_id',
        'isVisible',
        'isEnable',
    ];

    /**
     * 體育場次
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * 體育群組
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sportGroup()
    {
        return $this->belongsTo(SportGroup::class);
    }

    /**
     * Get the game's id.
     *
     * @param  string  $value
     * @return string
     */
    public function getGameIdAttribute($value)
    {
        return (string)$value;
    }
}
