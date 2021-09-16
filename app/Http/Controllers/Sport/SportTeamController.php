<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\SportLeague;
use App\Models\SportTeam;
use Illuminate\Http\Request;

class SportTeamController extends Controller
{
    /**
     * 新增
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        $name = $request->input('name');
        $sportLeagueId = $request->input('sport_league_id');

        if (!SportLeague::find($sportLeagueId)) {
            return ['msg' => 'not found sportLeague.'];
        }

        $criteria = [
            'name' => $name,
            'sport_league_id' => $sportLeagueId,
        ];

        if (SportTeam::where($criteria)->first()) {
            return ['msg' => 'Duplicate entry.'];
        }

        $sportTeam = SportTeam::create($criteria);
        $sportTeam->save();

        return $sportTeam;
    }

    /**
     * 取得隊伍
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function get(Request $request, $id)
    {
        return SportTeam::find($id) ?? ['msg' => 'not found'];
    }

    /**
     * 取得隊伍列表
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function getList(Request $request)
    {
        $sportLeagueId = $request->input('sport_league_id');

        if (!SportLeague::find($sportLeagueId)) {
            return ['msg' => 'not found sportLeague.'];
        }

        $sportLeague = SportTeam::where('sport_league_id', $sportLeagueId)
            ->get()
            ->makeHidden([
                'sport_league_id',
                'created_at',
                'updated_at',
            ]);

        return $sportLeague ?? ['msg' => 'not found'];
    }
}
