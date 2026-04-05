<?php

class CalendarController extends Controller {

    public function index() {
        require_once "../app/models/Task.php";
        $taskModel = new Task();

        $tasks = $taskModel->getByUser($_SESSION['user']['id']);

        $this->view('pages/calendar', [
            'tasks' => $tasks
        ]);
    }
}