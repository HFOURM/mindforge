<?php

class Router {

    private $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $uri = str_replace('/mindforge/public', '', $uri);

        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];

            list($controller, $method) = explode('@', $action);

            require_once BASE_PATH . "/app/controllers/web/$controller.php";

            $controller = new $controller();
            $controller->$method();
        } else {
            echo "404 Not Found";
        }
    }
}