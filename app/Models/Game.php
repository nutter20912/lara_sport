<?php

namespace App\Models;

class Game extends Model
{
    /**
     * @var string
     */
    protected $table = 'game';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'sport_category_id',
        'sport_league_id',
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
     * 體育聯盟
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sportLeague()
    {
        return $this->belongsTo(SportLeague::class);
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

    /**
     * Get the game's id.
     *
     * @param  string  $value
     * @return string
     */
    public function getIdAttribute($value)
    {
        return (string)$value;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'sport_category_id' => $this->sportCategory->id,
            'sport_category_name' => $this->sportCategory->name,
            'sport_league_id' => $this->sportLeague->id,
            'sport_league_name' => $this->sportLeague->name,
            'main_team_id' => $this->mainTeam->id,
            'main_team_name' => $this->mainTeam->name,
            'visit_team_id' => $this->visitTeam->id,
            'visit_team_name' => $this->visitTeam->name,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
