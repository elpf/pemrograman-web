<?php

namespace app\Traits;

// Trait untuk formatting response
trait ApiResponseFormatter
{
    
    public function apiResponse($code = 200, $message = "success", $data = [])
    {
        header("Content-Type: application/json");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Expires: 0");
        // Memformat response ke dalam bentuk JSON
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}
