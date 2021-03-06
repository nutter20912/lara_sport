<?php

namespace App\Http\Controllers\Sport;

use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SportLeagueRequest;
use App\Models\SportCategory;
use App\Models\SportLeague;
use App\Services\Sport\SportLeagueService;
use Illuminate\Support\Facades\Response;

class SportLeagueController extends Controller
{
    /**
     * 建立體育聯盟
     *
     * @OA\Post(
     *      path="/api/sport/league",
     *      operationId="postSportLeague",
     *      tags={"sport.league"},
     *      summary="建立體育聯盟",
     *      description="建立體育聯盟",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={
     *                  "sport_category_id",
     *                  "name",
     *              },
     *              @OA\Property(property="sport_category_id", description="體育類別編號", type="integer"),
     *              @OA\Property(property="name", description="體育聯盟名稱", type="string"),
     *          )
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     * )
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(
        SportLeagueRequest $request,
        SportLeagueService $sportLeagueService
    ) {
        $name = $request->input('name');
        $sportCategoryId = $request->input('sport_category_id');

        $sportLeague = $sportLeagueService->create(
            $name,
            $sportCategoryId,
        );

        return Response::apiSuccess($sportLeague);
    }

    /**
     * 回傳體育聯盟
     *
     * @OA\Get(
     *      path="/api/sport/league/{id}",
     *      operationId="getSportLeague",
     *      tags={"sport.league"},
     *      summary="回傳體育聯盟",
     *      description="回傳體育聯盟",
     *      @OA\Parameter(name="id", description="體育聯盟編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        if (!$sportLeague = SportLeague::find($id)) {
            throw new NotFoundHttpException('sport.league not found', 10001);
        }

        return Response::apiSuccess($sportLeague);
    }

    /**
     * 取得聯盟列表
     *
     * @OA\Get(
     *      path="/api/sport/league",
     *      operationId="getAllSportLeague",
     *      tags={"sport.league"},
     *      summary="回傳體育聯盟列表",
     *      description="回傳體育聯盟列表",
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     * )
     *
     * @return mixed
     */
    public function getList()
    {
        return Response::apiSuccess(SportCategory::all());
    }
}
