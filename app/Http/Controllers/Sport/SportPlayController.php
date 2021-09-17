<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\SportPlay;
use Illuminate\Http\Request;

class SportPlayController extends Controller
{
    /**
     * 新增體育玩法
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        $name = $request->input('name');

        if (SportPlay::where('name', $name)->first()) {
            return ['msg' => 'Duplicate entry.'];
        }

        $sportPlay = new SportPlay();
        $sportPlay->name = $name;
        $sportPlay->save();

        return $sportPlay;
    }

    /**
     * 查詢體育玩法
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        return SportPlay::find($id) ?? ['msg' => 'not found'];
    }
}
