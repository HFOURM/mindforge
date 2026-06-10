<?php

require_once BASE_PATH . '/app/models/Task.php';
require_once BASE_PATH . '/app/helpers/Response.php';

class TaskController extends Controller
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    public function index()
    {
        $user = $_SERVER['user'];
        $userId = is_array($user) ? $user['id'] : $user->id;

        $tasks = $this->taskModel->getByUser($userId);
        
        Response::success('Success fetch tasks', $tasks);
    }

    public function getByDate($date)
    {
        $user = $_SERVER['user'];
        $userId = is_array($user) ? $user['id'] : $user->id;

        $tasks = $this->taskModel->getTasksByDate($userId, $date);

        
        
        Response::success('Success fetch tasks by date', $tasks);
    }

    public function store()
    {
        $user = $_SERVER['user'];
        $userId = is_array($user) ? $user['id'] : $user->id;

        $input = json_decode(file_get_contents('php://input'), true);

        // Validation & Mass Assignment Prevention
        if (!isset($input['title']) || empty(trim($input['title']))) {
            Response::error('Title is required', 400);
            return;
        }

        $data = [
            'user_id' => $userId,
            'project_id' => $input['project_id'] ?? null,
            'title' => htmlspecialchars(trim($input['title'])),
            'deadline' => $input['deadline'] ?? null,
            'priority' => $input['priority'] ?? 'low',
            'status' => $input['status'] ?? 'todo',
            'note' => isset($input['note']) ? htmlspecialchars(trim($input['note'])) : null
        ];

        try {
            $this->taskModel->create($data);
            Response::success('Task created successfully', null, 201);
        } catch (Exception $e) {
            Response::error('Failed to create task', 500);
        }
    }

    public function updateStatus($id)
{
    $user = $_SERVER['user'];

    $userId =
        is_array($user)
            ? $user['id']
            : $user->id;

    $task =
        $this->taskModel
            ->findByIdAndUserId(
                $id,
                $userId
            );

    if (!$task) {
        Response::error(
            'Task not found',
            404
        );
        return;
    }

    $input =
        json_decode(
            file_get_contents(
                'php://input'
            ),
            true
        );

    $status =
        $input['status'] ??
        'Todo';

    $this->taskModel
        ->updateStatusapp(
            $id,
            $status
        );

    Response::success(
        'Status updated'
    );
}

    public function update($id)
    {
        $user = $_SERVER['user'];
        $userId = is_array($user) ? $user['id'] : $user->id;

        // IDOR Check
        $existingTask = $this->taskModel->findByIdAndUserId($id, $userId);
        if (!$existingTask) {
            Response::error('Task not found or unauthorized', 403);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        // Validation & Mass Assignment Prevention
        if (!isset($input['title']) || empty(trim($input['title']))) {
            Response::error('Title is required', 400);
            return;
        }

        $data = [
            'id' => $id,
            'project_id' => $input['project_id'] ?? $existingTask['project_id'],
            'title' => htmlspecialchars(trim($input['title'])),
            'deadline' => $input['deadline'] ?? $existingTask['deadline'],
            'priority' => $input['priority'] ?? $existingTask['priority'],
            'status' => $input['status'] ?? $existingTask['status'],
            'note' => isset($input['note']) ? htmlspecialchars(trim($input['note'])) : $existingTask['note']
        ];

        try {
            $this->taskModel->update($data);
            Response::success('Task updated successfully');
        } catch (Exception $e) {
            Response::error('Failed to update task', 500);
        }
    }

    public function destroy($id)
    {
        $user = $_SERVER['user'];
        $userId = is_array($user) ? $user['id'] : $user->id;

        // IDOR Check
        $existingTask = $this->taskModel->findByIdAndUserId($id, $userId);
        if (!$existingTask) {
            Response::error('Task not found or unauthorized', 403);
            return;
        }

        try {
            $this->taskModel->delete($id);
            Response::success('Task deleted successfully');
        } catch (Exception $e) {
            Response::error('Failed to delete task', 500);
        }
    }
}
