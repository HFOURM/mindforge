<?php

class TaskController extends Controller {

    public function index() {
        $user = $_SESSION['user'];
        require_once "../app/models/Project.php";
        $projectModel = new Project();

        require_once "../app/models/Task.php";
        $taskModel = new Task();

        $tasks = $taskModel->getByUser($_SESSION['user']['id']);

        $projects = $projectModel->getByUser($_SESSION['user']['id']);
        $this->view('pages/tasks', [
            'title' => 'Tasks',
            'projects' => $projects,
            'tasks' => $tasks,
        ]);
    }

    public function store() {

        require_once "../app/models/Task.php";
        $taskModel = new Task();

        $taskModel->create([
            'user_id' => $_SESSION['user']['id'],
            'project_id' => !empty($_POST['project_id']) ? $_POST['project_id'] : null,
            'title' => $_POST['title'],
            'deadline' => $_POST['deadline'],
            'priority' => $_POST['priority'],
            'status' => $_POST['status'],
            'note' => $_POST['note']
        ]);

        header("Location: /mindforge/public/tasks");
    }

    public function update(){
        require_once "../app/models/Task.php";
        $taskModel = new Task();

        $taskModel->update([
            'id' => $_POST['id'],
            'title' => $_POST['title'] ?? '',
            'note' => $_POST['note'] ?? '',
            'deadline' => $_POST['deadline'] ?? null,
            'priority' => $_POST['priority'] ?? 'Low',
            'status' => $_POST['status'] ?? 'Todo',
            'project_id' => !empty($_POST['project_id']) ? $_POST['project_id'] : null
        ]);

        header('Location: /mindforge/public/tasks');
        exit;
}

public function updateStatus(){
    header('Content-Type: application/json');
    ob_start(); 

    try {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        if (!$data) {
            echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
            exit;
        }

        $id = $data['id'] ?? null;
        $status = $data['status'] ?? null;

        if (!$id || !$status) {
            echo json_encode(['success' => false, 'error' => 'Missing data']);
            exit;
        }

        require_once "../app/models/Task.php";
        $taskModel = new Task();
        
        $result = $taskModel->updateStatus($id, $status);
    
        ob_clean();
        
        echo json_encode(['success' => $result]);
        exit;

    } catch (Exception $e) {
        ob_clean();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit;
    }
}
}