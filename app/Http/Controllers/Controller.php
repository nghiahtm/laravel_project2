<?php

namespace App\Http\Controllers;


abstract class Controller
{
    public function  sentSuccessResponse($data = "", $message = "success", $status = 200)
    {
        return \response()->json([
            'data'=>$data,
                "message"=>$message,
                "status_code"=>$status
            ]
        );
    }

    public function  sentErrorResponse($message = "error", $status = 200)
    {
        return \response()->json([
                'data'=>null,
                "message"=>$message,
                "status_code"=>$status
            ],
            $status
        );
    }
}
