<?php

require_once "../app/core/Database.php";

class Project
{

    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function countFilteredProjects($userId, $priority = '', $status = '', $search = '')
    {
        $sql = "SELECT COUNT(*) as total
            FROM projects
            WHERE user_id = ?";

        $params = [$userId];

        if (!empty($priority)) {
            $sql .= " AND priority = ?";
            $params[] = $priority;
        }

        if (!empty($status)) {
            $sql .= " AND status = ?";
            $params[] = $status;
        }

        if (!empty($search)) {
            $sql .= " AND name LIKE ?";
            $params[] = "%{$search}%";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['total'];
    }

    public function getFilteredProjectsPaginated(
    $userId,
    $priority = '',
    $status = '',
    $search = '',
    $limit = 9,
    $offset = 0
) {
    $sql = "
        SELECT
            p.*,
            COUNT(t.id) as total_tasks,
            SUM(
                CASE
                    WHEN t.status = 'Done'
                    THEN 1
                    ELSE 0
                END
            ) as completed_tasks,
            ROUND(
                (
                    SUM(
                        CASE
                            WHEN t.status = 'Done'
                            THEN 1
                            ELSE 0
                        END
                    ) /
                    NULLIF(COUNT(t.id),0)
                ) * 100
            ) as progress
        FROM projects p
        LEFT JOIN tasks t
            ON t.project_id = p.id
        WHERE p.user_id = ?
    ";

    $params = [$userId];

    if (!empty($priority)) {
        $sql .= " AND p.priority = ?";
        $params[] = $priority;
    }

    if (!empty($status)) {
        $sql .= " AND p.status = ?";
        $params[] = $status;
    }

    if (!empty($search)) {
        $sql .= " AND p.name LIKE ?";
        $params[] = "%{$search}%";
    }

    $sql .= "
        GROUP BY p.id
        ORDER BY p.id DESC
        LIMIT ? OFFSET ?
    ";

    $stmt = $this->conn->prepare($sql);

    $index = 1;

    foreach ($params as $param) {
        $stmt->bindValue($index++, $param);
    }

    $stmt->bindValue($index++, (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue($index++, (int)$offset, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    

    public function countByUser($userId)
    {
        $stmt = $this->conn->prepare("
        SELECT COUNT(*) as total
        FROM projects
        WHERE user_id = ?
    ");

        $stmt->execute([$userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO projects (user_id, name, deadline, priority, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['user_id'],
            $data['name'],
            $data['deadline'],
            $data['priority'],
            $data['description']
        ]);
    }

    public function update($id, $data)
{
    $query = "UPDATE projects 
              SET 
                name = :name,
                description = :description,
                deadline = :deadline,
                priority = :priority
              WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->execute([
        ':id' => $id,
        ':name' => $data['name'],
        ':description' => $data['description'],
        ':deadline' => $data['deadline'],
        ':priority' => $data['priority']
    ]);
}

    public function getByUser($userId)
    {

        $stmt = $this->conn->prepare("SELECT * FROM projects WHERE user_id = ?");
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUserWithStats($userId)
    {

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

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM projects WHERE id = ?");
        return $stmt->execute([$id]);
    }
}