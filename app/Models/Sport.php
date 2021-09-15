<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    SportCategory,
    SportType,
    SportPlay
};

/**
 * 體育
 */
class Sport extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'sport';

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
