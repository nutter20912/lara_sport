<?php

namespace App\Http\Controllers\Sport;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SportTeamRequest;
use App\Models\SportLeague;
use App\Models\SportTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SportTeamController extends Controller
{
    /**
     * 建立體育隊伍
     *
     * @OA\Post(
     *      path="/api/sport/team",
     *      operationId="postSportTeam",
     *      tags={"sport"},
     *      summary="建立體育隊伍",
     *      description="建立體育隊伍",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={
     *                  "sport_league_id",
     *                  "name",
     *              },
     *              @OA\Property(property="sport_league_id", description="體育聯盟編號", type="integer"),
     *              @OA\Property(property="name", description="體育隊伍名稱", type="string"),
     *          )
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     * )
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(SportTeamRequest $request)
    {
        $name = $request->input('name');
        $sportLeagueId = $request->input('sport_league_id');

        if (!SportLeague::find($sportLeagueId)) {
            throw new BadRequestException('Sport league not found.', 10003);
        }

        $criteria = [
            'name' => $name,
            'sport_league_id' => $sportLeagueId,
        ];

        if (SportTeam::where($criteria)->first()) {
            throw new BadRequestException('Duplicate entry.', 10003);
        }

        $sportTeam = SportTeam::create($criteria);
        $sportTeam->save();

        return Response::apiSuccess($sportTeam);
    }

    /**
     * 回傳體育隊伍
     *
     * @OA\Get(
     *      path="/api/sport/team/{id}",
     *      operationId="getSportTeam",
     *      tags={"sport"},
     *      summary="回傳體育隊伍",
     *      description="回傳體育隊伍",
     *      @OA\Parameter(name="id", description="體育隊伍編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        if (!$sportTeam = SportTeam::find($id)) {
            throw new NotFoundHttpException('sport team not found', 10001);
        }

        return Response::apiSuccess($sportTeam);
    }

    /**
     * 回傳體育隊伍列表
     *
     * @OA\Get(
     *      path="/api/sport/team/league/{id}",
     *      operationId="getAllSportTeam",
     *      tags={"sport"},
     *      summary="回傳體育隊伍列表",
     *      description="回傳體育隊伍列表",
     *      @OA\Parameter(name="id", description="體育聯盟編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @return mixed
     */
    public function getByLeague($id)
    {
        $sportLeague = SportTeam::where('sport_league_id', $id)->get();

        if ($sportLeague->isEmpty()) {
            throw new NotFoundHttpException('sport team not found', 10001);
        }

        return Response::apiSuccess($sportLeague);
    }
}
