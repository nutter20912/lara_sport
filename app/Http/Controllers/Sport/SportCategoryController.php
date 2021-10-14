<?php

namespace App\Http\Controllers\Sport;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SportCategoryController extends Controller
{
    /**
     * 建立體育類別
     *
     * @OA\Post(
     *      path="/api/sport/category",
     *      operationId="postSportCategory",
     *      tags={"sport"},
     *      summary="建立體育類別",
     *      description="建立體育類別",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", description="體育類別名稱", type="string"),
     *          )
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     * )
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        $name = $request->input('name');

        if (!$name) {
            throw new BadRequestException('Invalid name.', 10002);
        }

        if (SportCategory::where('name', $name)->first()) {
            throw new BadRequestException('Duplicate entry.', 10003);
        }

        $sportCategory = new SportCategory();
        $sportCategory->name = $name;
        $sportCategory->save();

        return Response::apiSuccess($sportCategory);
    }

    /**
     * 回傳體育類別
     *
     * @OA\Get(
     *      path="/api/sport/category/{id}",
     *      operationId="getSportCategory",
     *      tags={"sport"},
     *      summary="回傳體育類別",
     *      description="回傳體育類別",
     *      @OA\Parameter(name="id", description="體育類別編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        if (!$sportCategory = SportCategory::find($id)) {
            throw new NotFoundHttpException('sport category not found', 10001);
        }

        return Response::apiSuccess($sportCategory);
    }

    /**
     * 回傳體育類別列表
     *
     * @OA\Get(
     *      path="/api/sport/category",
     *      operationId="getAllSportCategory",
     *      tags={"sport"},
     *      summary="回傳體育類別列表",
     *      description="回傳體育類別列表",
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    public function getAll()
    {
        return Response::apiSuccess(SportCategory::all());
    }
}
