<?php

require_once "../app/core/Database.php";

class Event
{

    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO events (user_id, title, event_date,start_time,end_time, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['user_id'],
            $data['title'],
            $data['event_date'],
            $data['start_time'],
            $data['end_time'],
            $data['description']
        ]);
    }

    public function getByUser($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM events WHERE user_id = ? ORDER BY event_date ASC, start_time ASC");
        $stmt->execute([$user_id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan data dalam bentuk array asosiatif
    }
}