<?php

require_once BASE_PATH . '/app/helpers/Response.php';
require_once BASE_PATH . '/app/helpers/Jwt.php';
require_once BASE_PATH . '/app/models/User.php';

class AuthController extends Controller
{
    public function googleLogin()
    {
        $input = json_decode(
            file_get_contents("php://input"),
            true
        );
        if (!isset($input['id_token'])) {

            Response::error(
                'ID Token required',
                400
            );
        }

        $idToken = $input['id_token'];

        $googleApi =
            "https://oauth2.googleapis.com/tokeninfo?id_token="
            . $idToken;

        $response = @file_get_contents($googleApi);

        if (!$response) {

            Response::error(
                'Invalid Google token',
                401
            );
        }

        $googleUser = json_decode($response, true);

        if (!isset($googleUser['sub'])) {

            Response::error(
                'Google authentication failed',
                401
            );
        }

        $googleId = $googleUser['sub'];
        $email = $googleUser['email'];
        $name = $googleUser['name'];

        $userModel = new User();

        $user = $userModel->findOrCreate(
            $name,
            $email,
            $googleId
        );

        $jwt = Jwt::generate([
            'id' => $user['id'],
            'email' => $user['email']
        ]);

        Response::success(
            'Login berhasil',
            [
                'token' => $jwt,
                'user' => $user
            ],
            200
        );
    }
}