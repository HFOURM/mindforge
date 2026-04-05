<?php

class DashboardController extends Controller {

    public function index() {
        $user = $_SESSION['user'];

        require_once "../app/models/Task.php";
        $taskModel = new Task();
        $tasks = $taskModel->getByUser($_SESSION['user']['id']);

        $this->view('pages/dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
            'tasks' => $tasks
        ]);
    }
}
