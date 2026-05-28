<?php

require_once "../app/core/Database.php";

class Task
{

    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO tasks (user_id, project_id, title, deadline, priority, status, note) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['user_id'],
            $data['project_id'],
            $data['title'],
            $data['deadline'],
            $data['priority'],
            $data['status'],
            $data['note']
        ]);
    }

    public function getFilteredTasks(
        $userId,
        $priority = '',
        $projectId = '',
        $search = ''
    ) {
        $sql = "
        SELECT
            t.*,
            p.name as project_name
        FROM tasks t

        LEFT JOIN projects p
            ON p.id = t.project_id

        WHERE t.user_id = ?
    ";

        $params = [$userId];

        if (!empty($priority)) {

            $sql .= " AND t.priority = ?";

            $params[] = $priority;
        }

        if (!empty($projectId)) {

            $sql .= " AND t.project_id = ?";

            $params[] = $projectId;
        }

        if (!empty($search)) {
            $sql .= "
            AND (
                t.title LIKE ?
                OR t.note LIKE ?
            )
        ";

            $keyword = "%{$search}%";

            $params[] = $keyword;
            $params[] = $keyword;
        }


        $sql .= " ORDER BY t.id DESC";

        $stmt =
            $this->conn->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($userId)
    {

        $stmt = $this->conn->prepare("
            SELECT tasks.*, projects.name as project_name
            FROM tasks
            LEFT JOIN projects ON tasks.project_id = projects.id
            WHERE tasks.user_id = ?
            ORDER BY tasks.created_at DESC
        ");

        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $query = "UPDATE tasks 
                SET title = ?, note = ?, deadline = ?, priority = ?, status = ?, project_id = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['title'],
            $data['note'],
            $data['deadline'] ?: null,
            $data['priority'],
            $data['status'],
            $data['project_id'] ?: null,
            $data['id']
        ]);
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByProject($projectId)
    {

        $stmt = $this->conn->prepare("
            SELECT * FROM tasks 
            WHERE project_id = ?
            ORDER BY created_at DESC
        ");

        $stmt->execute([$projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
