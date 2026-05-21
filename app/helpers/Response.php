<?php

class Response
{
    public static function json($data, $status = 200)
    {
        http_response_code($status);

        header('Content-Type: application/json');

        echo json_encode($data);

        exit;
    }

    public static function success($message = 'Success', $data = null, $status = 200)
    {
        self::json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public static function error($message = 'Error', $status = 500)
    {
        self::json([
            'success' => false,
            'message' => $message
        ], $status);
    }
}