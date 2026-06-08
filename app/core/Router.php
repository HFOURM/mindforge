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

    public function delete($uri, $action, $middleware = null) {
        $this->routes['DELETE'][$uri] = [
            'action' => $action,
            'middleware' => $middleware
        ];
    }


    public function run() {
        session_start();

        // Ambil Request Method dan URI
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Normalisasi URI dengan menghapus base path jika ada
        $uri = str_replace('/mindforge/public', '', $uri);

        // Cek satu per satu apakah cocok dengan Requst url dari user
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routeUri => $route) {

                $pattern = preg_replace('#\{[a-zA-Z_]+\}#', '([^/]+)', $routeUri);
                $pattern = "#^" . $pattern . "$#";

                if (preg_match($pattern, $uri, $matches)) {

                    array_shift($matches);

                    if ($route['middleware']) {
                        require_once BASE_PATH . "/app/middleware/{$route['middleware']}.php";
                        $middleware = $route['middleware'];
                        $middleware::handle();
                    }

                    list($controller, $methodAction) = explode('@', $route['action']);

                    $folder = strpos($uri, '/api/') === 0 ? 'api' : 'web';
                    require_once BASE_PATH . "/app/controllers/$folder/$controller.php";

                    $controller = new $controller();

                    call_user_func_array([$controller, $methodAction], $matches);

                    return;
                }
            }
        }

    echo "404 Not Found";
}
}