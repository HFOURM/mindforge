<?php

require_once BASE_PATH . '/app/helpers/Jwt.php';
require_once BASE_PATH . '/app/helpers/Response.php';
require_once BASE_PATH . '/app/models/User.php';

class AuthController extends Controller
{
    public function login() {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['email'])) {
            Response::error('Email is required', 400);
            return;
        }

        $email = $input['email'];
        
        $userModel = new User();
        // Cek user by email
        // Karena di User.php hanya ada findOrCreate untuk google, kita buat query manual
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Auto create for demo purpose
            $userModel->findOrCreate(explode('@', $email)[0], $email, 'demo_' . time());
            
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // JWT PAYLOAD
        $payload = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];

        // generate JWT
        $token = Jwt::generate($payload);

        Response::success(
            'Login successful',
            [
                'token' => $token,
                'user' => $user
            ]
        );
    }

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
