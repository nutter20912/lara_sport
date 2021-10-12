<?php

namespace App\Http\Controllers\Sport;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundHttpException;
use App\Http\Controllers\Controller;
use App\Models\SportType;
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
     *      tags={"sport"},
     *      summary="建立體育場別",
     *      description="建立體育場別",
     *      @OA\RequestBody(
     *          description="create sport type",
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      @OA\Response(response=200, ref="#/components/responses/Success"),
     *      @OA\Response(response=400, ref="#/components/responses/BadRequest")
     * )
     *
     * @param  Illuminate\Http\Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        $name = $request->input('name');

        if (!$name) {
            throw new BadRequestException('Invalid name.', 10012);
        }

        if (SportType::where('name', $name)->first()) {
            throw new BadRequestException('Duplicate entry.', 10013);
        }

        $sportType = new SportType();
        $sportType->name = $name;
        $sportType->save();

        return Response::apiSuccess($sportType);
    }

    /**
     * 回傳體育場別
     *
     * @OA\Get(
     *      path="/api/sport/type/{id}",
     *      operationId="getSportType",
     *      tags={"sport"},
     *      summary="回傳體育場別",
     *      description="回傳體育場別",
     *      @OA\Parameter(
     *          name="id",
     *          description="sport type id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
}
