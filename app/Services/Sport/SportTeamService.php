<?php

namespace App\Services\Sport;

use App\Exceptions\BadRequestException;
use App\Models\SportLeague;
use App\Models\SportTeam;

class SportTeamService
{
    /**
     * 建立體育隊伍
     *
     * @param int $name
     * @param int $sportLeagueId
     */
    public function create($name, $sportLeagueId): SportTeam
    {
        if (!$sportLeague = SportLeague::find($sportLeagueId)) {
            throw new BadRequestException('Sport league not found.', 10003);
        }

        $criteria = [
            'name' => $name,
            'sport_league_id' => $sportLeagueId,
        ];

        if (SportTeam::where($criteria)->first()) {
            throw new BadRequestException('Duplicate entry.', 10003);
        }

        $sportTeam = new SportTeam();
        $sportTeam->name = $name;
        $sportTeam->sportLeague()->associate($sportLeague);
        $sportTeam->save();

        return $sportTeam;
    }
}
