<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('apiSuccess', function ($result) {
            return Response::json([
                'code' => 200,
                'message' => 'ok',
                'result' => $result,
            ], 200);
        });

        Response::macro('apiFail', function ($respone, $httpCode) {
            return Response::json([
                'code' => $respone['code'],
                'message' => $respone['message'],
                'result' => null,
            ], $httpCode);
        });
    }
}
