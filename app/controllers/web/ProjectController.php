<?php

class ProjectController extends Controller {

    public function index() {

        require_once "../app/models/Project.php";
        $projectModel = new Project();

        $projects = $projectModel->getByUserWithStats($_SESSION['user']['id']);

        $this->view('pages/project', [
            'title' => 'Projects',
            'projects' => $projects
        ]);
    }

    public function store() {

        require_once "../app/models/Project.php";
        $projectModel = new Project();

        $projectModel->create([
            'user_id' => $_SESSION['user']['id'],
            'name' => $_POST['title'],
            'deadline' => $_POST['deadline'],
            'priority' => $_POST['priority'],
            'description' => $_POST['description']
        ]);

        header("Location: /mindforge/public/projects");
    }

    public function detail($id) {

        require_once "../app/models/Project.php";
        require_once "../app/models/Task.php";

        $projectModel = new Project();
        $taskModel = new Task();

        $project = $projectModel->getById($id);
        $tasks = $taskModel->getByProject($id);
        $projects = $projectModel->getByUser($_SESSION['user']['id']);

        $this->view('pages/detailproject', [
            'project' => $project,
            'tasks' => $tasks,
            'projects' => $projects
        ]);
    }
}