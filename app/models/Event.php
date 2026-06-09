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
        $stmt = $this->conn->prepare("INSERT INTO events (user_id, title, event_date,start_time,end_time, description, reminder) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['user_id'],
            $data['title'],
            $data['event_date'],
            $data['start_time'],
            $data['end_time'],
            $data['description'],
            $data['reminder']
        ]);
    }

    public function getByUser($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM events WHERE user_id = ? ORDER BY event_date ASC, start_time ASC");
        $stmt->execute([$user_id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan data dalam bentuk array asosiatif
    }

    public function getEventsByDate($userId, $date)
    {
        // Karena struktur tabel memisahkan event_date, komparasi langsung sudah index-friendly jika tipe kolom adalah DATE.
        $stmt = $this->conn->prepare("
            SELECT * FROM events 
            WHERE user_id = ? 
            AND event_date = ? 
            ORDER BY start_time ASC
        ");
        $stmt->execute([$userId, $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTomorrowEvents()
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE status = 'scheduled'
            AND event_date = DATE_ADD(CURDATE(), INTERVAL 1 DAY)
            ORDER BY start_time ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUpcomingEventsWithinOneHour()
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE status = 'scheduled'
            AND TIMESTAMPDIFF(
                MINUTE,
                NOW(),
                CONCAT(event_date, ' ', start_time)
            ) BETWEEN 0 AND 60
            ORDER BY start_time ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTodayEvents($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE user_id = ?
            AND status = 'scheduled'
            AND event_date = CURDATE()
            ORDER BY start_time ASC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countTodayEvents($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) AS total
            FROM events
            WHERE user_id = ?
            AND status = 'scheduled'
            AND event_date = CURDATE()
        ");

        $stmt->execute([$userId]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $result['total'];
    }

    public function getUpcomingEvents($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE user_id = ?
            AND status = 'scheduled'
            AND event_date BETWEEN CURDATE()
            AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
            ORDER BY event_date ASC, start_time ASC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventsByDateRange(
        $userId,
        $startDate,
        $endDate
    ) {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE user_id = ?
            AND event_date BETWEEN ? AND ?
            ORDER BY event_date ASC, start_time ASC
        ");

        $stmt->execute([
            $userId,
            $startDate,
            $endDate
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPastEvents($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE user_id = ?
            AND (
                event_date < CURDATE()
                OR status = 'completed'
            )
            ORDER BY event_date DESC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE id = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getTodayEventsForNotification()
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE status = 'scheduled'
            AND event_date = CURDATE()
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
