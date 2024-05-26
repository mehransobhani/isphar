<?php

namespace App\Http\Traits\Helpers;

trait ApiResponseTrait
{
    protected function apiResponse($response, $resCode = 200, $resMsg = "")
    {
        return response()->json([
            "data" => $response,
            "res_code" => $resCode,
            "res_msg" => $resMsg
        ]);
    }
}
