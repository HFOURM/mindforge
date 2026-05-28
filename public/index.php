<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// === TAMBAHKAN BROADCAST CORS UNTUK FLUTTER WEB DI SINI ===
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept");

// Matikan proses jika browser hanya mengirim preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
// ========================================================

require_once "../app/core/Env.php";

Env::load(__DIR__ . '/../.env');

define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '/mindforge/public');

require_once BASE_PATH . '/app/core/Router.php';
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/core/Database.php';

$router = new Router();

require_once BASE_PATH . '/routes/web.php';
require_once BASE_PATH . '/routes/api.php';

$router->run();
