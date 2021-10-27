<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\SportLeague;

/**
 * Class SportLeagueRepository.
 *
 * @package namespace App\Repositories;
 */
class SportLeagueRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SportLeague::class;
    }

    /**
     * 回傳體育聯盟
     *
     * @param int $id
     * @param int $sportCategoryId
     */
    public function getLeague($id, $sportCategoryId): ?SportLeague
    {
        return $this->where([
            'id' => $id,
            'sport_category_id' => $sportCategoryId,
        ])->first();
    }
}
