<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\SportType;
use Illuminate\Http\Request;

class SportTypeController extends Controller
{
    /**
     * 新增體育場別
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        $name = $request->input('name');

        if (SportType::where('name', $name)->first()) {
            return ['msg' => 'Duplicate entry.'];
        }

        $sportType = new SportType();
        $sportType->name = $name;
        $sportType->save();

        return $sportType;
    }

    /**
     * 查詢體育場別
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        return SportType::find($id) ?? ['msg' => 'not found'];
    }
}
