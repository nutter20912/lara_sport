<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\SportCategory;
use App\Models\SportTeam;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * 取得場次
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function get(Request $request, $id)
    {
        return Game::find($id) ?? ['msg' => 'not found'];
    }

    /**
     * 新增場次
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function post(Request $request)
    {
        $sportCategoryId = $request->input('sport_category_id');
        $sportMainId = $request->input('sport_main_id');
        $sportVisitId = $request->input('sport_visit_id');

        if (!SportCategory::find($sportCategoryId)) {
            return ['msg' => 'not found sportCategory.'];
        }

        if ($sportMainId == $sportVisitId) {
            return ['msg' => 'same Team.'];
        }

        $mainTeam = SportTeam::find($sportMainId);

        if (!$mainTeam) {
            return ['msg' => 'not found SportMainTeam.'];
        }

        if ($mainTeam->sportLeague->sportCategoryId != $sportCategoryId) {
            return ['msg' => 'Wrong mainTeam sportCategory.'];
        }

        $visitTeam = SportTeam::find($sportVisitId);

        if (!$visitTeam) {
            return ['msg' => 'not found sportVisitTeam.'];
        }

        if ($visitTeam->sportLeague->sportCategoryId != $sportCategoryId) {
            return ['msg' => 'Wrong visitTeam sportCategory.'];
        }

        $params = [
            'sport_category_id' => $sportCategoryId,
            'main_team_id' => $sportMainId,
            'visit_team_id' => $sportVisitId,
        ];

        $game = Game::create($params);
        $game->save();

        return $game;
    }
}
