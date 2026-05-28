<?php

require_once BASE_PATH . '/app/helpers/Jwt.php';
require_once BASE_PATH . '/app/helpers/Response.php';
require_once BASE_PATH . '/app/models/User.php';

class AuthController extends Controller
{
    public function googleCallback()
{
    $input = json_decode(
        file_get_contents("php://input"),
        true
    );

    $idToken = $input['id_token'] ?? null;

    if (!$idToken) {
        Response::error(
            'ID Token tidak ditemukan',
            400
        );
        return;
    }

    $googleApi = file_get_contents(
        "https://oauth2.googleapis.com/tokeninfo?id_token=" . $idToken
    );

    $googleUser = json_decode(
        $googleApi,
        true
    );

    if (!isset($googleUser['sub'])) {
        Response::error(
            'Token Google tidak valid',
            401
        );
        return;
    }

    $userModel = new User();

    // cari / buat user
    $user = $userModel->findOrCreate(
        $googleUser['name'],
        $googleUser['email'],
        $googleUser['sub']
    );

    // JWT PAYLOAD
    $payload = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email']
    ];

    // generate JWT
    $token = Jwt::generate($payload);

    Response::success(
        'Login berhasil',
        [
            'token' => $token,
            'user' => $user
        ]
    );
}
}
