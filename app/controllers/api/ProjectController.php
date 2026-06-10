<?php

require_once BASE_PATH . '/app/helpers/Response.php';
require_once BASE_PATH . '/app/models/Project.php';

class ProjectController extends Controller
{
    private $projectModel;

    public function __construct()
    {
        $this->projectModel = new Project();
    }
    public function index()
{
    $user = $_SERVER['user'];

    $userId = is_array($user)
        ? $user['id']
        : $user->id;

    $projects =
        $this->projectModel
            ->getByUserId(
                $userId
            );

    foreach ($projects as &$project) {

        $project['task_count'] =
            $this->projectModel
                ->countTasks(
                    $project['id']
                );
    }

    Response::success(
        'Success fetch projects',
        $projects
    );
}


public function store()
{
    $user = $_SERVER['user'];

    $userId = is_array($user)
        ? $user['id']
        : $user->id;

    $input = json_decode(
        file_get_contents("php://input"),
        true
    );

    // Validation
    if (
        !isset($input['name']) ||
        empty(trim($input['name']))
    ) {
        Response::error(
            'Project name is required',
            400
        );
        return;
    }

    $data = [
        'user_id' => $userId,

        'name' => htmlspecialchars(
            trim($input['name'])
        ),

        'description' => isset(
            $input['description']
        )
            ? htmlspecialchars(
                trim(
                    $input['description']
                )
            )
            : null,

        'deadline' =>
            $input['deadline']
            ?? null,

        'priority' =>
            $input['priority']
            ?? 'Low',
    ];

    try {

        $this->projectModel
            ->create($data);

        Response::success(
            'Project created successfully',
            null,
            201
        );

    } catch (Exception $e) {

        Response::error(
            'Failed to create project',
            500
        );
    }
}

public function show($id)
{
    $user = $_SERVER['user'];

    $userId = is_array($user)
        ? $user['id']
        : $user->id;

    $project = $this
        ->projectModel
        ->findByIdAndUserId(
            $id,
            $userId
        );

    if (!$project) {
        Response::error(
            'Project not found',
            404
        );
        return;
    }

    Response::success(
        'Success fetch project',
        $project
    );
}


}
