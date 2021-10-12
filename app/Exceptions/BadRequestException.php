<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;

class BadRequestException extends Exception
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
        ], 400);
    }
}