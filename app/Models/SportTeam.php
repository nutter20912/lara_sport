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

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sport_league_id' => $this->sportLeague->id,
            'sport_league_name' => $this->sportLeague->name,
        ];
    }
}
