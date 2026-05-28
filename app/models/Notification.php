<?php

require_once "../app/core/Database.php";

class Notification {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create(
        $userId,
        $title,
        $message,
        $type
    ){
        $stmt = $this->conn->prepare("
            INSERT INTO notifications
            (
                user_id,
                title,
                message,
                type
            )
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $userId,
            $title,
            $message,
            $type
        ]);
    }

    public function getByUser($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM notifications
            WHERE user_id = ?
            ORDER BY created_at DESC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUnread($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) as total
            FROM notifications
            WHERE user_id = ?
            AND is_read = 0
        ");

        $stmt->execute([$userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function markAsRead($id)
    {
        $stmt = $this->conn->prepare("
            UPDATE notifications
            SET is_read = 1
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    public function markAllRead($userId)
    {
        $stmt = $this->conn->prepare("
            UPDATE notifications
            SET is_read = 1
            WHERE user_id = ?
        ");

        return $stmt->execute([$userId]);
    }
}