<?php

class Controller {

    public function view($view, $data = []) {
        extract($data);

        ob_start();
        require "../app/views/$view.php";
        $content = ob_get_clean();

        require "../app/views/layouts/main.php";
    }

    public function component($name, $data = []) {
    extract($data);
    require "../app/views/components/$name.php";
}
}