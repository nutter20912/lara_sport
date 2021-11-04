<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="0.0.1",
 *      title="sport OpenApi",
 *      description="sport api doc"
 * )
 *
 * @OA\Server(
 *      url=API_HOST,
 *      description="local API server",
 *      @OA\ServerVariable(
 *          serverVariable="port",
 *          enum={"80", "3000"},
 *          default="80"
 *      )
 * )
 *
 * @OA\Schema(
 *      schema="success",
 *      description="基本回應格式",
 *      @OA\Property(property="message",type="string",example="ok")
 * )
 *
 * @OA\Schema(
 *      schema="response",
 *      description="基本回應格式",
 *      @OA\Property(property="message",type="string",example="ok"),
 *      @OA\Property(property="result",type="object",example={"id":"1"})
 * )
 *
 * @OA\Response(
 *      response="Success",
 *      description="success",
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="code",type="integer")
 *              ),
 *              @OA\Schema(ref="#/components/schemas/response")
 *          }
 *      )
 * )
 * @OA\Response(
 *      response="BadRequest",
 *      description="Bad Request."
 * )
 * @OA\Response(
 *      response="NotFound",
 *      description="Resource not found."
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
