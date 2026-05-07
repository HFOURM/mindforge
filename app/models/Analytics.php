<?php

require_once "../app/core/Database.php";

class Analytics {

    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getWeeklyActivity($userId) {

        $stmt = $this->conn->prepare("
            SELECT 
                DAYNAME(created_at) AS day,
                COUNT(*) AS total_activity
            FROM tasks
            WHERE user_id = ?
            GROUP BY DAYNAME(created_at)
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaskCompletion($userId) {

        $stmt = $this->conn->prepare("
            SELECT 
                status,
                COUNT(*) AS total
            FROM tasks
            WHERE user_id = ?
            GROUP BY status
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFocusTime($userId) {

        $stmt = $this->conn->prepare("
            SELECT 
                week,
                total_hours
            FROM focus_times
            WHERE user_id = ?
            ORDER BY id ASC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMoodTracking($userId) {

        $stmt = $this->conn->prepare("
            SELECT 
                day_name,
                mood_level
            FROM mood_tracking
            WHERE user_id = ?
            ORDER BY id ASC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}