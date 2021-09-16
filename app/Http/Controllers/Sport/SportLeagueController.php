<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\SportCategory;
use App\Models\SportLeague;
use Illuminate\Http\Request;

class SportLeagueController extends Controller
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
        $sportCategoryId = $request->input('sport_category_id');

        if (!SportCategory::find($sportCategoryId)) {
            return ['msg' => 'not found SportCategory.'];
        }

        $criteria = [
            'sport_category_id' => $sportCategoryId,
            'name' => $name,
        ];

        if (SportLeague::where($criteria)->first()) {
            return ['msg' => 'Duplicate entry.'];
        }

        $sportLeague = SportLeague::create($criteria);
        $sportLeague->save();

        return $sportLeague;
    }

    /**
     * 取得聯盟
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function get(Request $request, $id)
    {
        return SportLeague::find($id) ?? ['msg' => 'not found'];
    }

    /**
     * 取得聯盟列表
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function getList(Request $request)
    {
        $sportCategoryId = $request->input('sport_category_id');

        if (!SportCategory::find($sportCategoryId)) {
            return ['msg' => 'not found SportCategory.'];
        }

        $sportLeague = SportLeague::where('sport_category_id', $sportCategoryId)
            ->get()
            ->makeHidden([
                'sport_category_id',
                'created_at',
                'updated_at',
            ]);

        return $sportLeague ?? ['msg' => 'not found'];
    }
}
