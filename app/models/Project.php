<?php

require_once "../app/core/Database.php";

class Project {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getByUser($userId) {

        $stmt = $this->conn->prepare("SELECT * FROM projects WHERE user_id = ?");
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}