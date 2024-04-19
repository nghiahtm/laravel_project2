<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvalidOrderException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request,Exception $exception): Response
    {
        return response()->view('errors.user');
    }
}
