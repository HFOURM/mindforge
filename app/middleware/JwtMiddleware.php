<?php

require_once BASE_PATH . '/app/helpers/Jwt.php';
require_once BASE_PATH . '/app/helpers/Response.php';

class JwtMiddleware
{
    public static function handle()
    {
        $headers = getallheaders();

        $authHeader = null;

        // Normal header
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
        }

        // lowercase fallback
        elseif (isset($headers['authorization'])) {
            $authHeader = $headers['authorization'];
        }

        // Apache fallback
        elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        }

        if (!$authHeader) {
            Response::error(
                'Token required',
                401
            );
        }

        if (
            !preg_match(
                '/Bearer\s(\S+)/',
                $authHeader,
                $matches
            )
        ) {
            Response::error(
                'Invalid token format',
                401
            );
        }

        $jwt = $matches[1];

        // verify jwt
        $user = Jwt::verify($jwt);

        if (!$user) {
            Response::error(
                'Invalid or expired token',
                401
            );
        }

        // simpan payload jwt
        $_SERVER['user'] = $user;
    }
}
