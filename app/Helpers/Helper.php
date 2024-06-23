<?php

    function successResponse($message, $statusCode = 200, $data = null)
    {
        $response = [
            'message' => $message,
            'status_code' => $statusCode,
        ];

        if (! is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    function errorResponse($message, $statusCode = 400)
    {
        $response = [

            'message' => $message,
            'status_code' => $statusCode,

        ];

        return response()->json($response, $statusCode);
    }

    function generateRandomNumber($count = 8)
    {
        return substr(str_shuffle("1234567890"), 0, $count);
    }
