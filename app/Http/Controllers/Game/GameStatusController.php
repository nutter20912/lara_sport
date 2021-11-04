<?php

namespace App\Http\Controllers\Game;

use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Http\Requests\GameStatusRequest;
use App\Models\Game;
use App\Models\GameStatus;
use App\Services\Game\GameStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GameStatusController extends Controller
{
    /**
     * 建立場次狀態
     *
     * @OA\Post(
     *      path="/api/game/{game_id}/status",
     *      operationId="postGameStatus",
     *      tags={"game.status"},
     *      summary="建立場次狀態",
     *      description="建立場次狀態",
     *      @OA\Parameter(name="game_id", description="場次編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"sport_group_id"},
     *              @OA\Property(property="sport_group_id", description="體育群組編號", type="integer"),
     *              @OA\Property(property="visibled", description="是否顯示", type="integer"),
     *              @OA\Property(property="enabled", description="是否可投", type="integer"),
     *          )
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param Illuminate\Http\Request $request
     * @return mixed
     */
    protected function post(
        GameStatusRequest $request,
        GameStatusService $gameStatusService,
        int $gameId,
    ) {
        $sportGroupId = $request->integer('sport_group_id');
        $visibled = $request->input('visibled');
        $enabled = $request->input('enabled');

        $options = [
            'visibled' => $visibled,
            'enabled' => $enabled,
        ];

        $gameStatus = $gameStatusService->create(
            $gameId,
            $sportGroupId,
            $options,
        );

        return Response::apiSuccess($gameStatus);
    }

    /**
     * 回傳場次狀態
     *
     * @OA\Get(
     *      path="/api/game/{game_id}/status/{status_id}",
     *      operationId="getGameStatus",
     *      tags={"game.status"},
     *      summary="回傳場次狀態",
     *      description="回傳場次狀態",
     *      @OA\Parameter(name="game_id", description="場次編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Parameter(name="status_id", description="場次狀態編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function get(int $gameId, int $statusId)
    {
        if (!Game::find($gameId)) {
            throw new NotFoundHttpException('game not found', 10001);
        }

        if (!$gameStatus = GameStatus::find($statusId)) {
            throw new NotFoundHttpException('gameStatus not found', 10001);
        }

        return Response::apiSuccess($gameStatus);
    }

    /**
     * 依場次編號回傳狀態
     *
     * @OA\Get(
     *      path="/api/game/{game_id}/status",
     *      operationId="getGameAllStatus",
     *      tags={"game.status"},
     *      summary="回傳場次狀態",
     *      description="回傳場次狀態",
     *      @OA\Parameter(name="game_id", description="場次狀態編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    protected function getByGame($gameId)
    {
        if (!$gameStatus = GameStatus::find($gameId)) {
            throw new NotFoundHttpException('gameStatus not found', 10001);
        }

        return Response::apiSuccess($gameStatus);
    }
}
