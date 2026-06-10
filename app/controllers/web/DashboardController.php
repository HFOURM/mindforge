<?php

class DashboardController extends Controller
{

    public function index()
    {
        $user = $_SESSION['user'];
        $userId = $user['id'];

        require_once "../app/models/Task.php";
        require_once "../app/models/Project.php";
        require_once "../app/models/Event.php";
        require_once "../app/models/Notification.php";

        $taskModel = new Task();
        $projectModel = new Project();
        $eventModel = new Event();
        $notificationModel = new Notification();

        $tasks = $taskModel->getByUser($userId);
        $projects = $projectModel->getByUser($userId);
        $events = $eventModel->getByUser($userId);

        // Bersihkan notifikasi task yang sudah selesai (Done) sebelum generate yang baru
        $notificationModel->cleanupResolvedTaskNotifications($userId);

        foreach ([3, 2, 1] as $days) {

            $deadlineTasks = $taskModel->getTasksDeadlineIn($days, $userId);

            foreach ($deadlineTasks as $task) {

                $notificationModel->createIfNotExists(
                    "task_{$task['id']}_h{$days}",
                    $task['user_id'],
                    "Deadline Task",
                    "Task '{$task['title']}' akan berakhir {$days} hari lagi.",
                    "task_deadline",
                    $task['id']
                );
            }
        }

        if (method_exists($taskModel, 'getTodayDeadlineTasksForNotification')) {

            $todayTasks =
                $taskModel->getTodayDeadlineTasksForNotification($userId);

            foreach ($todayTasks as $task) {

                $notificationModel->createIfNotExists(
                    "task_{$task['id']}_today",
                    $task['user_id'],
                    "Deadline Hari Ini",
                    "Task '{$task['title']}' memiliki deadline hari ini.",
                    "task_deadline",
                    $task['id']
                );
            }
        }

        $overdueTasks =
            $taskModel->getOverdueTasks($userId);

        foreach ($overdueTasks as $task) {

            $notificationModel->createIfNotExists(
                "task_{$task['id']}_overdue",
                $task['user_id'],
                "Task Terlambat",
                "Task '{$task['title']}' telah melewati deadline.",
                "task_deadline",
                $task['id']
            );
        }

        foreach ([3, 2, 1] as $days) {

            $deadlineProjects =
                $projectModel->getProjectsDeadlineIn($days);

            foreach ($deadlineProjects as $project) {

                if ($project['user_id'] != $userId) {
                    continue;
                }

                $notificationModel->createIfNotExists(
                    "project_{$project['id']}_h{$days}",
                    $project['user_id'],
                    "Deadline Project",
                    "Project '{$project['name']}' akan berakhir {$days} hari lagi.",
                    "project_deadline",
                    $project['id']
                );
            }
        }

        if (method_exists($projectModel, 'getTodayDeadlineProjectsForNotification')) {

            $todayProjects =
                $projectModel->getTodayDeadlineProjectsForNotification();

            foreach ($todayProjects as $project) {

                if ($project['user_id'] != $userId) {
                    continue;
                }

                $notificationModel->createIfNotExists(
                    "project_{$project['id']}_today",
                    $project['user_id'],
                    "Deadline Project Hari Ini",
                    "Project '{$project['name']}' memiliki deadline hari ini.",
                    "project_deadline",
                    $project['id']
                );
            }
        }

        // Gunakan getScheduledForTomorrow() agar event yang sudah dikirim
        // notifikasi H-1-nya (reminder_h1_sent=1) tidak dikirim ulang
        $tomorrowEvents =
            $eventModel->getScheduledForTomorrow();

        foreach ($tomorrowEvents as $event) {

            if ($event['user_id'] != $userId) {
                continue;
            }

            $created = $notificationModel->createIfNotExists(
                "event_{$event['id']}_h1",
                $event['user_id'],
                "Reminder Event",
                "Event '{$event['title']}' akan berlangsung besok.",
                "event_reminder",
                $event['id']
            );

            // Tandai flag agar tidak dikirim lagi di siklus berikutnya
            if ($created) {
                $eventModel->markReminderH1Sent($event['id']);
            }
        }

        $todayEvents =
            $eventModel->getTodayEventsForNotification();

        foreach ($todayEvents as $event) {

            if ($event['user_id'] != $userId) {
                continue;
            }

            $notificationModel->createIfNotExists(
                "event_{$event['id']}_today",
                $event['user_id'],
                "Event Hari Ini",
                "Event '{$event['title']}' dijadwalkan hari ini.",
                "event_reminder",
                $event['id']
            );
        }

        $upcomingEvents =
            $eventModel->getUpcomingEventsWithinOneHour();

        foreach ($upcomingEvents as $event) {

            if ($event['user_id'] != $userId) {
                continue;
            }

            $notificationModel->createIfNotExists(
                "event_{$event['id']}_1hour",
                $event['user_id'],
                "Reminder Event",
                "Event '{$event['title']}' akan dimulai kurang dari 1 jam lagi.",
                "event_reminder",
                $event['id']
            );
        }

        // --- Logika Project & Tasks ---
        $totalProjects = count($projects);
        $projectsThisMonth = 0;
        foreach ($projects as $p) {
            if (isset($p['created_at']) && date('Y-m', strtotime($p['created_at'])) === date('Y-m')) {
                $projectsThisMonth++;
            }
        }

        $totalOpenTasks = 0;
        $tasksDueToday = 0;
        $totalTasks = count($tasks);
        $completedTasks = 0;
        foreach ($tasks as $t) {
            if ($t['status'] !== 'Done') {
                $totalOpenTasks++;
                if (isset($t['deadline']) && date('Y-m-d', strtotime($t['deadline'])) === date('Y-m-d')) {
                    $tasksDueToday++;
                }
            } else {
                $completedTasks++;
            }
        }
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // --- LOGIKA DINAMIS TASK DISTRIBUTION PER PROJECT ---
        $projectDistribution = [];
        
        if ($totalTasks > 0) {
            foreach ($projects as $p) {
                $taskCountInProject = 0;
                
                foreach ($tasks as $t) {
                    if (isset($t['project_id']) && $t['project_id'] == $p['id']) {
                        $taskCountInProject++;
                    }
                }
                
                $percentage = round(($taskCountInProject / $totalTasks) * 100);
                
                $projectDistribution[] = [
                    'name' => $p['name'] ?? $p['title'] ?? 'Unnamed Project',
                    'task_count' => $taskCountInProject,
                    'percentage' => $percentage
                ];
            }
            
            // Urutkan dari distribusi task terbanyak (besar ke kecil)
            usort($projectDistribution, function($a, $b) {
                return $b['percentage'] <=> $a['percentage'];
            });

            // REVISI: Ambil 5 data teratas saja
            $projectDistribution = array_slice($projectDistribution, 0, 5);
        }

        // --- LOGIKA DINAMIS UPCOMING EVENTS ---
        $now = date('Y-m-d H:i:s');
        $upcomingEventsCount = 0;
        $nextEventStr = 'No upcoming events';
        $upcomingEventsList = [];

        foreach ($events as $e) {
            $eventStart = $e['event_date'] . ' ' . $e['start_time'];

            if ($eventStart >= $now) {
                $upcomingEventsCount++;
                $upcomingEventsList[] = $e;

                if ($nextEventStr === 'No upcoming events') {
                    $timeFormatted = date('H:i', strtotime($e['start_time']));
                    $nextEventStr = $e['title'] . ' – ' . $timeFormatted;
                }
            }
        }

        $dashboardData = [
            'activeProjects' => [
                'total' => $totalProjects,
                'thisMonth' => $projectsThisMonth
            ],
            'openTasks' => [
                'total' => $totalOpenTasks,
                'dueToday' => $tasksDueToday
            ],
            'upcomingEvents' => [
                'total' => $upcomingEventsCount,
                'next' => $nextEventStr,
                'list' => $upcomingEventsList
            ],
            'completionRate' => [
                'rate' => $completionRate,
                'trend' => "{$completedTasks} of {$totalTasks} tasks completed"
            ],
            'projectDistribution' => $projectDistribution // Dilempar ke view
        ];

        $notifications =
            $notificationModel->getLatestByUser(
                $userId,
                20
            );

        $unreadCount =
            $notificationModel->countUnread(
                $userId
            );

        $this->view('pages/dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
            'tasks' => $tasks,
            'dashboardData' => $dashboardData,
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
}
