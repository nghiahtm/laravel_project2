<?php

namespace App\Exceptions;

use Exception;


class ExceptionNotFound extends Exception
{
     public function render()
        {
            return response()->json([
                "error"=>"error",
            ]);
        }
}
