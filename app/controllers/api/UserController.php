<?php

require_once BASE_PATH . '/app/helpers/Response.php';
require_once BASE_PATH . '/app/models/User.php';

class UserController extends Controller
{
    public function profile()
    {
        $jwtUser = $_SERVER['user'];

        $userModel = new User();

        // ambil data lengkap dari DB
        $user = $userModel->findById(
            $jwtUser['id']
        );

        Response::success(
            'Profile berhasil diambil',
            $user
        );
    }
}
