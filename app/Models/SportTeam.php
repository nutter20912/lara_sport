<?php

namespace App\Models;

/**
 * 體育隊伍
 */
class SportTeam extends Model
{
    /**
     * @var string
     */
    protected $table = 'sport_team';

    /**
     * @var array
     */
    protected $fillable = [
        'sport_league_id',
        'name',
    ];

    /**
     * 體育聯盟
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sportLeague()
    {
        return $this->belongsTo(SportLeague::class);
    }
}
