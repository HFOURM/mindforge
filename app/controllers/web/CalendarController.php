<?php

class CalendarController extends Controller {

    public function index() {
        require_once "../app/models/Task.php";
        $taskModel = new Task();

        $tasksRaw = $taskModel->getByUser($_SESSION['user']['id']);

        $tasks = [];

        foreach ($tasksRaw as $task) {
            $day = date('j', strtotime($task['deadline']));
            $month = date('n', strtotime($task['deadline']));
            $year = date('Y', strtotime($task['deadline']));

            if ($month == ($_GET['month'] ?? date('n')) && $year == ($_GET['year'] ?? date('Y'))) {
                $tasks[$day][] = $task;
            }
        }

        $this->view('pages/calendar', [
            'tasks' => $tasks
        ]);
    }
}