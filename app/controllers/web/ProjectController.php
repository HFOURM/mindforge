<?php

class ProjectController extends Controller
{

    public function index()
    {
        require_once "../app/models/Project.php";

        $projectModel = new Project();

        $limit = 9;

        $page = isset($_GET['page'])
            ? max(1, (int)$_GET['page'])
            : 1;

        $offset = ($page - 1) * $limit;

        $priority = $_GET['priority'] ?? '';
        $status   = $_GET['status'] ?? '';
        $search   = trim($_GET['search'] ?? '');

        $totalProjects = $projectModel->countFilteredProjects(
            $_SESSION['user']['id'],
            $priority,
            $status,
            $search
        );

        $projects = $projectModel->getFilteredProjectsPaginated(
            $_SESSION['user']['id'],
            $priority,
            $status,
            $search,
            $limit,
            $offset
        );

        $totalPages = ceil($totalProjects / $limit);

        $this->view('pages/project', [
            'title'      => 'Projects',
            'projects'   => $projects,
            'page'       => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function store()
    {

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

    public function detail($id)
    {

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

    public function update()
    {
        $id = $_POST['id'];
        require_once "../app/models/Project.php";

        $projectModel = new Project();
        $data = [
            'name' => $_POST['title'],
            'description' => $_POST['description'],
            'deadline' => $_POST['deadline'],
            'priority' => $_POST['priority']
        ];

        $projectModel->update($id, $data);

        header('Location: ' . BASE_URL . '/projects/' . $id);
    }

    public function delete()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo "ID tidak ditemukan";
            return;
        }

        require_once "../app/models/Project.php";
        $projectModel = new Project();

        $success = $projectModel->delete($id);

        if ($success) {
            $redirect = '/mindforge/public/projects';
            header("Location: " . $redirect);
            exit;
        } else {
            echo "Gagal menghapus task";
        }
    }
}
