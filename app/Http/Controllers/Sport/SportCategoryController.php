<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\SportCategory;
use Illuminate\Http\Request;

class SportCategoryController extends Controller
{
    /**
     * get sport
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        $name = $request->input('name');

        if (SportCategory::where('name', $name)->first()) {
            return ['msg' => 'Duplicate entry.'];
        }

        $sportCategory = new SportCategory();
        $sportCategory->name = $name;
        $sportCategory->save();

        return $sportCategory;
    }

    /**
     * 查詢體育類別
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        return SportCategory::find($id) ?? ['msg' => 'not found'];
    }
}
