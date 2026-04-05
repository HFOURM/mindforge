<?php

class AuthController extends Controller {

    private $client_id;
    private $client_secret;
    private $redirect_uri;
    

    public function __construct() {
        $this->client_id = $_ENV['GOOGLE_CLIENT_ID'];
        $this->client_secret = $_ENV['GOOGLE_CLIENT_SECRET'];
        $this->redirect_uri = $_ENV['GOOGLE_REDIRECT_URI'];
    }

    public function index() {
        $this->view('pages/login', [
            'title' => 'Login'
        ]);
    }

    public function logout() {
        session_start();

        session_unset();
        session_destroy();

        header("Location: /mindforge/public/auth/login");
        exit;
    }

    public function googleLogin() {
        session_start();

        $_SESSION['oauth_state'] = bin2hex(random_bytes(16));

        $url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'code',
            'scope' => 'email profile',
            'state' => $_SESSION['oauth_state'],
            'prompt' => 'select_account'
        ]);

        header("Location: $url");
        exit;
    }

    public function googleCallback() {
        session_start();

        if ($_GET['state'] !== $_SESSION['oauth_state']) {
            die("Invalid state");
        }

        $code = $_GET['code'];

        $token = file_get_contents("https://oauth2.googleapis.com/token", false,
            stream_context_create([
                "http" => [
                    "method" => "POST",
                    "header" => "Content-type: application/x-www-form-urlencoded",
                    "content" => http_build_query([
                        'code' => $code,
                        'client_id' => $this->client_id,
                        'client_secret' => $this->client_secret,
                        'redirect_uri' => $this->redirect_uri,
                        'grant_type' => 'authorization_code'
                    ])
                ]
            ])
        );

        $token = json_decode($token, true);
        $access_token = $token['access_token'];

        $user = file_get_contents("https://www.googleapis.com/oauth2/v2/userinfo", false,
            stream_context_create([
                "http" => [
                    "header" => "Authorization: Bearer $access_token"
                ]
            ])
        );

        $user = json_decode($user, true);

        $email = $user['email'];
        $name = $user['name'];
        $provider_id = $user['id'];

        require_once "../app/models/User.php";
        $userModel = new User();

        $user = $userModel->findOrCreate($name, $email, $provider_id);

        $_SESSION['user'] = $user;

        header("Location: /mindforge/public/");
        exit;
    }
}