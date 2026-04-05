<?php

require_once "../app/core/Database.php";

class User {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function findOrCreate($name, $email, $provider_id) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $stmt = $this->conn->prepare(
                "INSERT INTO users (name, email, provider, provider_id) VALUES (?, ?, 'google', ?)"
            );
            $stmt->execute([$name, $email, $provider_id]);

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $user;
    }

    public function update($id, $name, $email) {
        $stmt = $this->conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$name, $email, $id]);
    }
}