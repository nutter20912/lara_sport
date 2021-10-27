<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\SportTeam;

/**
 * Class SportTeamRepository.
 *
 * @package namespace App\Repositories;
 */
class SportTeamRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SportTeam::class;
    }

    /**
     * 回傳體育隊伍
     *
     * @param int $id
     * @param int $sportCategoryId
     */
    public function getTeam($id, $sportLeagueId): ?SportTeam
    {
        return $this->where([
            'id' => $id,
            'sport_league_id' => $sportLeagueId,
        ])->first();
    }
}
