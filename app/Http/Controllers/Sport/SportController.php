<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use App\Models\SportCategory;
use App\Models\SportPlay;
use App\Models\SportType;
use Illuminate\Http\Request;

class SportController extends Controller
{
    /**
     * 取得體育項目
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function get(Request $request, $id)
    {
        return Sport::find($id) ?? ['msg' => 'not found'];
    }

    /**
     * 新增體育項目
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function post(Request $request)
    {
        $sportCategoryId = $request->input('sport_category_id');
        $sportTypeId = $request->input('sport_type_id');
        $sportPlayId = $request->input('sport_play_id');

        if (!SportCategory::find($sportCategoryId)) {
            return ['msg' => 'not found SportCategory.'];
        }

        if (!SportType::find($sportTypeId)) {
            return ['msg' => 'not found SportType.'];
        }

        if (!SportPlay::find($sportPlayId)) {
            return ['msg' => 'not found SportPlay.'];
        }

        $params = [
            'sport_category_id' => $sportCategoryId,
            'sport_type_id' => $sportTypeId,
            'sport_play_id' => $sportPlayId,
        ];

        if (Sport::where($params)->first()) {
            return ['msg' => 'Duplicate sport.'];
        }

        $sport = Sport::create($params);
        $sport->save();

        return $sport;
    }
}
