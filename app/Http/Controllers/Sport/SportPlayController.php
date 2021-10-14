<?php

namespace App\Http\Controllers\Sport;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Models\SportPlay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SportPlayController extends Controller
{
    /**
     * 建立體育玩法
     *
     * @OA\Post(
     *      path="/api/sport/play",
     *      operationId="postSportPlay",
     *      tags={"sport"},
     *      summary="建立體育玩法",
     *      description="建立體育玩法",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string"),
     *          ),
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     * )
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        $name = $request->input('name');

        if (!$name) {
            throw new BadRequestException('Invalid name.', 10022);
        }

        if (SportPlay::where('name', $name)->first()) {
            throw new BadRequestException('Duplicate entry.', 10023);
        }

        $sportPlay = new SportPlay();
        $sportPlay->name = $name;
        $sportPlay->save();

        return Response::apiSuccess($sportPlay);
    }

    /**
     * 回傳體育玩法
     *
     * @OA\Get(
     *      path="/api/sport/play/{id}",
     *      operationId="getSportPlay",
     *      tags={"sport"},
     *      summary="回傳體育玩法",
     *      description="回傳體育玩法",
     *      @OA\Parameter(name="id", description="體育玩法編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        if (!$sportPlay = SportPlay::find($id)) {
            throw new NotFoundHttpException('sport category not found', 10021);
        }

        return Response::apiSuccess($sportPlay);
    }

    /**
     * 回傳體育玩法列表
     *
     * @OA\Get(
     *      path="/api/sport/play",
     *      operationId="getAllSportPlay",
     *      tags={"sport"},
     *      summary="回傳體育玩法列表",
     *      description="回傳體育玩法列表",
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    public function getAll()
    {
        return Response::apiSuccess(SportPlay::all());
    }
}
