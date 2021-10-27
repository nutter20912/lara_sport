<?php

namespace App\Http\Controllers\Game;

use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Http\Requests\GameRequest;
use App\Services\Game\GameService;
use App\Models\Game;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Support\Facades\Response;

class GameController extends Controller
{
    /**
     * 回傳場次
     *
     * @OA\Get(
     *      path="/api/game/{id}",
     *      operationId="getGame",
     *      tags={"game"},
     *      summary="回傳場次",
     *      description="回傳場次",
     *      @OA\Parameter(name="id", description="回傳場次", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function get($id)
    {
        if (!$game = Game::find($id)) {
            throw new NotFoundHttpException('game not found', 10001);
        }

        return Response::apiSuccess($game);
    }

    /**
     * 建立場次
     *
     * @OA\Post(
     *      path="/api/game",
     *      operationId="postGame",
     *      tags={"game"},
     *      summary="建立場次",
     *      description="建立場次",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={
     *                  "sport_category_id",
     *                  "sport_league_id",
     *                  "main_team_id",
     *                  "visit_team_id",
     *              },
     *              @OA\Property(property="sport_category_id", description="體育類別編號", type="integer"),
     *              @OA\Property(property="sport_league_id", description="體育聯盟編號", type="integer"),
     *              @OA\Property(property="main_team_id", description="主隊編號", type="integer"),
     *              @OA\Property(property="visit_team_id", description="客隊編號", type="integer"),
     *          )
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param Illuminate\Http\Request $request
     * @param App\Services\Game\GameService $gameService
     * @param Godruoyi\Snowflake\Snowflake $snowflake
     * @return mixed
     */
    protected function post(
        GameRequest $request,
        GameService $gameService,
        Snowflake $snowflake,
    ) {
        $sportCategoryId = $request->input('sport_category_id');
        $sportLeagueId = $request->input('sport_league_id');
        $mainTeamId = $request->input('main_team_id');
        $visitTeamId = $request->input('visit_team_id');

        $game = $gameService->create(
            (int)$snowflake->id(),
            $sportCategoryId,
            $sportLeagueId,
            $mainTeamId,
            $visitTeamId,
        );

        return Response::apiSuccess($game);
    }

    /**
     * 依類別回傳場次列表
     *
     * @OA\Get(
     *      path="/api/game/category/{id}",
     *      operationId="getGameByCategory",
     *      tags={"game"},
     *      summary="依類別回傳場次列表",
     *      description="依類別回傳場次列表",
     *      @OA\Parameter(name="id", description="依類別回傳場次列表", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function getByCategory($id)
    {
        $game = Game::where(['sport_category_id' => $id])
            ->with([
                'sportCategory',
                'sportLeague',
                'mainTeam',
                'visitTeam',
            ])
            ->get();

        if ($game->isEmpty()) {
            throw new NotFoundHttpException('games not found', 10001);
        }

        return Response::apiSuccess(
            $game->map(fn ($item) => collect($item)->except([
                'sport_category_id',
                'sport_category_name',
            ]))
        );
    }
}
