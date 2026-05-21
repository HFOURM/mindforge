<?php

require_once BASE_PATH . '/app/helpers/Jwt.php';
require_once BASE_PATH . '/app/helpers/Response.php';

class JwtMiddleware
{
    public static function handle()
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            Response::error('Token required', 401);
        }

        $authHeader = $headers['Authorization'];

        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            Response::error('Invalid token format', 401);
        }

        $jwt = $matches[1];

        $user = Jwt::verify($jwt);

        if (!$user) {
            Response::error('Invalid or expired token', 401);
        }

        $_SERVER['user'] = $user;
    }
}