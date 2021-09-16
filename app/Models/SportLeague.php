<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 體育聯盟
 */
class SportLeague extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'sport_league';

    /**
     * @var array
     */
    protected $fillable = [
        'sport_category_id',
        'name',
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
}
