<?php

class AnalyticController extends Controller {

    public function index() {

        require_once "../app/models/Analytics.php";

        $analyticModel = new Analytics();

        $weeklyActivity = $analyticModel->getWeeklyActivity($_SESSION['user']['id']);

        $taskCompletion = $analyticModel->getTaskCompletion($_SESSION['user']['id']);

        $focusTime = $analyticModel->getFocusTime($_SESSION['user']['id']);

        $this->view('pages/analytics', [
            'title' => 'Analytics',
            'weeklyActivity' => $weeklyActivity,
            'taskCompletion' => $taskCompletion,
            'focusTime' => $focusTime,
        ]);
    }
}