<?php

class DashboardController extends Controller {

    public function index() {
        $user = $_SESSION['user'];
        $userId = $user['id'];

        require_once "../app/models/Task.php";
        require_once "../app/models/Project.php";
        
        $taskModel = new Task();
        $projectModel = new Project();
        
        $tasks = $taskModel->getByUser($userId);
        $projects = $projectModel->getByUser($userId);

        // Hitung Active Projects
        $totalProjects = count($projects);
        $projectsThisMonth = 0;
        foreach($projects as $p) {
            if (isset($p['created_at']) && date('Y-m', strtotime($p['created_at'])) === date('Y-m')) {
                $projectsThisMonth++;
            }
        }

        // 2 & 4. Hitung Open Tasks & Completion Rate
        $totalOpenTasks = 0;
        $tasksDueToday = 0;
        $totalTasks = count($tasks);
        $completedTasks = 0;

        foreach($tasks as $t) {
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

        // Data yang akan dilempar ke view
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
                'total' => 5, // Masih Data dummy karena belum ada tabel event
                'next' => 'Team Sync – 14:00'
            ],
            'completionRate' => [
                'rate' => $completionRate,
                'trend' => '↑ 12% from last week' // Dummy trend
            ]
        ];

        $this->view('pages/dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
            'tasks' => $tasks,
            'dashboardData' => $dashboardData
        ]);
    }
}
