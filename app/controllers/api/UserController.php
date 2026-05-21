<?php

require_once BASE_PATH . '/app/helpers/Response.php';

class UserController extends Controller
{
    public function profile()
    {
        $user = $_SERVER['user'];

        Response::success(
            'Profile berhasil diambil',
            $user
        );
    }
}

