<?php

class Router {

    private $routes = [];

    public function get($uri, $action, $middleware = null) {
        $this->routes['GET'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function post($uri, $action, $middleware = null) {
        $this->routes['POST'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function put($uri, $action, $middleware = null) {
        $this->routes['PUT'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function run() {
        session_start();

        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $uri = str_replace('/mindforge/public', '', $uri);

        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];

            if ($route['middleware']) {
                require_once BASE_PATH . "/app/middleware/{$route['middleware']}.php";
                $middleware = $route['middleware'];
                $middleware::handle();
            }

            $action = $route['action'];
            list($controller, $method) = explode('@', $action);

            require_once BASE_PATH . "/app/controllers/web/$controller.php";

            $controller = new $controller();
            $controller->$method();

        } else {
            echo "404 Not Found";
        }
    }
}