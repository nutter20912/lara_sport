<?php

namespace App\Http\Controllers\Sport;

use App\Exceptions\{
    BadRequestException,
    NotFoundHttpException
};
use App\Http\Controllers\Controller;
use App\Models\{
    SportGroup,
    SportCategory,
    SportPlay,
    SportType
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SportGroupController extends Controller
{
    /**
     * 建立體育群組
     *
     * @OA\Post(
     *      path="/api/sport/group",
     *      operationId="postSportGroup",
     *      tags={"sport"},
     *      summary="建立體育群組",
     *      description="建立體育群組",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={
     *                  "sport_category_id",
     *                  "sport_type_id",
     *                  "sport_play_id",
     *              },
     *              @OA\Property(property="sport_category_id", type="integer"),
     *              @OA\Property(property="sport_type_id", type="integer"),
     *              @OA\Property(property="sport_play_id", type="integer"),
     *          ),
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function post(Request $request)
    {
        $sportCategoryId = $request->input('sport_category_id');
        $sportTypeId = $request->input('sport_type_id');
        $sportPlayId = $request->input('sport_play_id');

        if (!$sportCategoryId) {
            throw new BadRequestException('Invalid sportCategoryId.', 10032);
        }

        if (!$sportTypeId) {
            throw new BadRequestException('Invalid sportTypeId.', 10033);
        }

        if (!$sportPlayId) {
            throw new BadRequestException('Invalid sportPlayId.', 10034);
        }

        if (!SportCategory::find($sportCategoryId)) {
            throw new NotFoundHttpException('Sport Category not found', 10035);
        }

        if (!SportType::find($sportTypeId)) {
            throw new NotFoundHttpException('Sport Type not found', 10036);
        }

        if (!SportPlay::find($sportPlayId)) {
            throw new NotFoundHttpException('Sport Play not found', 10037);
        }

        $params = [
            'sport_category_id' => $sportCategoryId,
            'sport_type_id' => $sportTypeId,
            'sport_play_id' => $sportPlayId,
        ];

        if (SportGroup::where($params)->first()) {
            throw new BadRequestException('Duplicate entry.', 10038);
        }

        $sportGroup = SportGroup::create($params);
        $sportGroup->save();

        return Response::apiSuccess($sportGroup);
    }

    /**
     * 回傳體育群組
     *
     * @OA\Get(
     *      path="/api/sport/group/{id}",
     *      operationId="getSportGroup",
     *      tags={"sport"},
     *      summary="回傳體育群組",
     *      description="回傳體育群組",
     *      @OA\Parameter(name="id", description="體育群組編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    protected function get($id)
    {
        if (!$sportGroup = SportGroup::find($id)) {
            throw new NotFoundHttpException('sport Group not found', 10031);
        }

        return Response::apiSuccess($sportGroup);
    }

    /**
     * 回傳體育群組列表
     *
     * @OA\Get(
     *      path="/api/sport/group",
     *      operationId="getAllSportGroup",
     *      tags={"sport"},
     *      summary="回傳體育群組列表",
     *      description="回傳體育群組列表",
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    protected function getAll()
    {
        return Response::apiSuccess(SportGroup::all());
    }
}
