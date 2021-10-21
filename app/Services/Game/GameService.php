<?php

namespace App\Services\Game;

use App\Models\SportCategory;
use App\Models\SportTeam;
use App\Exceptions\BadRequestException;
use App\Models\Game;
use App\Models\SportLeague;

class GameService
{
    public function create($params): Game
    {
        [
            'sport_category_id' => $sportCategoryId,
            'sport_league_id' => $sportLeagueId,
            'main_team_id' => $mainTeamId,
            'visit_team_id' => $visitTeamId,
        ] = $params;

        if ($mainTeamId == $visitTeamId) {
            throw new BadRequestException('same Team.', 20001);
        }

        if (!$sportCategory = SportCategory::find($sportCategoryId)) {
            throw new BadRequestException('sport category not found', 20001);
        }

        if (!$sportLeague = $this->getSportLeague($sportLeagueId, $sportCategoryId)) {
            throw new BadRequestException('sport league not found', 20001);
        }

        if (!$mainTeam = $this->getSportTeam($mainTeamId, $sportLeagueId)) {
            throw new BadRequestException('SportMainTeam not found', 20001);
        }

        if (!$visitTeam = $this->getSportTeam($visitTeamId, $sportLeagueId)) {
            throw new BadRequestException('sportVisitTeam not found', 20001);
        }

        $game = new Game();
        $game->sportCategory()->associate($sportCategory);
        $game->sportLeague()->associate($sportLeague);
        $game->mainTeam()->associate($mainTeam);
        $game->visitTeam()->associate($visitTeam);
        $game->save();

        return $game;
    }

    /**
     * 回傳體育聯盟
     *
     * @param int $id
     * @param int $sportCategoryId
     */
    public function getSportLeague($id, $sportCategoryId): ?SportLeague
    {
        return SportLeague::where([
            'id' => $id,
            'sport_category_id' => $sportCategoryId,
        ])->first();
    }

    /**
     * 回傳體育隊伍
     *
     * @param int $id
     * @param int $sportCategoryId
     */
    public function getSportTeam($id, $sportLeagueId): ?SportTeam
    {
        return SportTeam::where([
            'id' => $id,
            'sport_league_id' => $sportLeagueId,
        ])->first();
    }
}
