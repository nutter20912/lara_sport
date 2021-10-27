<?php

namespace App\Http\Controllers\Sport;

use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Models\SportType;
use App\Services\Sport\SportTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SportTypeController extends Controller
{
    /**
     * 建立體育場別
     *
     * @OA\Post(
     *      path="/api/sport/type",
     *      operationId="postSportType",
     *      tags={"sport.type"},
     *      summary="建立體育場別",
     *      description="建立體育場別",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name",type="string"),
     *          ),
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest"),
     * )
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(
        Request $request,
        SportTypeService $sportTypeService
        )
    {
        $name = $request->input('name');

        $sportType = $sportTypeService->create($name);

        return Response::apiSuccess($sportType);
    }

    /**
     * 回傳體育場別
     *
     * @OA\Get(
     *      path="/api/sport/type/{id}",
     *      operationId="getSportType",
     *      tags={"sport.type"},
     *      summary="回傳體育場別",
     *      description="回傳體育場別",
     *      @OA\Parameter(name="id", description="體育場別編號", required=true, in="path", @OA\Schema(type="integer")),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        if (!$sportType = SportType::find($id)) {
            throw new NotFoundHttpException('sport type not found', 10011);
        }

        return Response::apiSuccess($sportType);
    }

    /**
     * 回傳體育場別列表
     *
     * @OA\Get(
     *      path="/api/sport/type",
     *      operationId="getAllSportType",
     *      tags={"sport.type"},
     *      summary="回傳體育場別列表",
     *      description="回傳體育場別列表",
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound"),
     * )
     *
     * @param int $id
     * @return mixed
     */
    public function getAll()
    {
        return Response::apiSuccess(SportType::all());
    }
}
