<?php

namespace App\Http\Controllers\Sport;

use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SportGroupRequest;
use App\Models\SportGroup;
use App\Services\Sport\SportGroupService;
use Illuminate\Support\Facades\Response;

class SportGroupController extends Controller
{
    /**
     * 建立體育群組
     *
     * @OA\Post(
     *      path="/api/sport/group",
     *      operationId="postSportGroup",
     *      tags={"sport.group"},
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
    protected function post(
        SportGroupRequest $request,
        SportGroupService $sportGroupService,
    ) {
        $sportCategoryId = $request->input('sport_category_id');
        $sportTypeId = $request->input('sport_type_id');
        $sportPlayId = $request->input('sport_play_id');

        $sportGroup = $sportGroupService->create(
            $sportCategoryId,
            $sportTypeId,
            $sportPlayId
        );

        return Response::apiSuccess($sportGroup);
    }

    /**
     * 回傳體育群組
     *
     * @OA\Get(
     *      path="/api/sport/group/{id}",
     *      operationId="getSportGroup",
     *      tags={"sport.group"},
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
     * 依類別回傳體育群組列表
     *
     * @OA\Get(
     *      path="/api/sport/group/category/{id}",
     *      operationId="getSportGroupByCategory",
     *      tags={"sport.group"},
     *      summary="依類別回傳體育群組列表",
     *      description="依類別回傳體育群組列表",
     *      @OA\Parameter(name="id", description="體育類別編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    protected function getByCategory($id)
    {
        $sportGroups = SportGroup::where(['sport_category_id' => $id])
            ->with([
                'sportType',
                'sportPlay',
            ])
            ->get();

        if ($sportGroups->isEmpty()) {
            throw new NotFoundHttpException('sportGroups not found', 10001);
        }

        return Response::apiSuccess($sportGroups);
    }
}
