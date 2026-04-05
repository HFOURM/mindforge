<?php

require_once "../app/core/Database.php";

class Project {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO projects (user_id, name, deadline, priority, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['user_id'],
            $data['name'],
            $data['deadline'],
            $data['priority'],
            $data['description']
        ]);
    }

    public function getByUser($userId) {

        $stmt = $this->conn->prepare("SELECT * FROM projects WHERE user_id = ?");
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUserWithStats($userId) {

        $stmt = $this->conn->prepare("
            SELECT 
                p.*,
                COUNT(t.id) as total_tasks,
                SUM(CASE WHEN t.status = 'Done' THEN 1 ELSE 0 END) as completed_tasks
            FROM projects p
            LEFT JOIN tasks t ON t.project_id = p.id
            WHERE p.user_id = ?
            GROUP BY p.id
            ORDER BY p.created_at DESC
        ");

        $stmt->execute([$userId]);

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($projects as &$p) {
            $total = $p['total_tasks'];
            $done = $p['completed_tasks'];

            $p['progress'] = $total > 0 ? round(($done / $total) * 100) : 0;
        }

        return $projects;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}