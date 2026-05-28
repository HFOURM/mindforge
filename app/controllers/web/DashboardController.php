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

        $taskModel = new Task();
        $projectModel = new Project();
        $eventModel = new Event();

        $tasks = $taskModel->getByUser($userId);
        $projects = $projectModel->getByUser($userId);
        $events = $eventModel->getByUser($userId);

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
                'trend' => '↑ 12% from last week'
            ],
            'projectDistribution' => $projectDistribution // Dilempar ke view
        ];

        $this->view('pages/dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
            'tasks' => $tasks,
            'dashboardData' => $dashboardData
        ]);
    }
}
