<?php

namespace App\Models;

class Game extends Model
{
    /**
     * @var string
     */
    protected $table = 'game';

    /**
     * @var array
     */
    protected $fillable = [
        'sport_category_id',
        'main_team_id',
        'visit_team_id',
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
     * 主隊
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mainTeam()
    {
        return $this->belongsTo(SportTeam::class);
    }

    /**
     * 客隊
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitTeam()
    {
        return $this->belongsTo(SportTeam::class);
    }
}
