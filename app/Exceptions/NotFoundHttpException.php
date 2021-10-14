<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;

class NotFoundHttpException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return Response::apiFail([
            'code' => $this->getCode(),
            'message' => $this->getMessage(),
        ], 404);
    }

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        return null;
    }
}
