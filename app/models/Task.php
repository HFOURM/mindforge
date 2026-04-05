<?php

require_once "../app/core/Database.php";

class Task {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
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

    public function getByUser($userId) {

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

    public function update($data) {
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
}