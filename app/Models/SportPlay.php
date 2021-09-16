<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sport;

/**
 * 體育玩法
 */
class SportPlay extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'sport_play';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * 體育
     */
    public function sports()
    {
        return $this->hasMany(Sport::class);
    }
}
