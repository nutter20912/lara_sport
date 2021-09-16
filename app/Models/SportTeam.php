<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 體育隊伍
 */
class SportTeam extends Model
{
    use HasFactory;

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
