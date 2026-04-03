<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '/mindforge/public');

require_once BASE_PATH . '/app/core/Router.php';
require_once BASE_PATH . '/app/core/Controller.php';
// require_once BASE_PATH . '/app/core/Database.php';

$router = new Router();

require_once BASE_PATH . '/routes/web.php';
require_once BASE_PATH . '/routes/api.php';

$router->run();