<?php

class CalendarController extends Controller {

    public function index() {
    require_once "../app/models/Event.php";
    require_once "../app/models/Task.php";

    $eventModel = new Event();
    $taskModel = new Task();

    $userId = $_SESSION['user']['id'];
    $eventsRaw = $eventModel->getByUser($userId);
    $tasksRaw = $taskModel->getByUser($userId);

    $events = [];
    $tasks = [];

    $currentMonth = $_GET['month'] ?? date('n');
    $currentYear = $_GET['year'] ?? date('Y');

    foreach ($eventsRaw as $event) {
        $day = date('j', strtotime($event['event_date']));
        $month = date('n', strtotime($event['event_date']));
        $year = date('Y', strtotime($event['event_date']));

        if ($month == $currentMonth && $year == $currentYear) {
            $events[$day][] = $event;
        }
    }

    foreach ($tasksRaw as $task) {
        if (!empty($task['deadline'])) {
            $day = date('j', strtotime($task['deadline']));
            $month = date('n', strtotime($task['deadline']));
            $year = date('Y', strtotime($task['deadline']));

            if ($month == $currentMonth && $year == $currentYear) {
                $tasks[$day][] = $task;
            }
        }
    }

    $this->view('pages/calendar', [
        'events' => $events,
        'tasks' => $tasks
    ]);
}

    public function store()
    {

        require_once "../app/models/Event.php";
        $eventModel = new Event();

        $eventModel->create([
            'user_id' => $_SESSION['user']['id'],
            'title' => $_POST['title'],
            'event_date' => $_POST['event_date'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'description' => $_POST['description'],
            'reminder' => $_POST['reminder'] ?? null
        ]);

        header("Location: /mindforge/public/calendar");
    }
}