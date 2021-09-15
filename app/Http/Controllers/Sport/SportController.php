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

        $sportCategory = SportCategory::find($sportCategoryId);

        if (!$sportCategory) {
            return ['msg' => 'not found SportCategory.'];
        }

        $sportType = SportType::find($sportTypeId);

        if (!$sportType) {
            return ['msg' => 'not found SportType.'];
        }

        $sportPlay = SportPlay::find($sportPlayId);

        if (!$sportPlay) {
            return ['msg' => 'not found SportPlay.'];
        }

        $sport = Sport::where([
            'sport_category_id' => $sportCategoryId,
            'sport_type_id' => $sportTypeId,
            'sport_play_id' => $sportPlayId,
        ])->first();

        if ($sport) {
            return ['msg' => 'Duplicate sport.'];
        }

        $sport = new Sport();
        $sport->sportCategory()->associate($sportCategory);
        $sport->sportType()->associate($sportType);
        $sport->sportPlay()->associate($sportPlay);
        $sport->save();

        return $sport;
    }
}
