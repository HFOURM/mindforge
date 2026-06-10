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
        // project_id bersifat opsional: NULL jika event tidak terkait project
        $stmt = $this->conn->prepare("
            INSERT INTO events
                (user_id, project_id, title, event_date, start_time, end_time, description, reminder)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['user_id'],
            $data['project_id'] ?? null,  
            $data['title'],
            $data['event_date'],
            $data['start_time']     ?? null,
            $data['end_time']       ?? null,
            $data['description']    ?? null,
            $data['reminder']       ?? null,   // DATETIME reminder dari user
            // reminder_h1_sent tidak perlu di-insert; default-nya 0 di DB
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("
            UPDATE events
            SET
                title       = :title,
                event_date  = :event_date,
                start_time  = :start_time,
                end_time    = :end_time,
                description = :description,
                reminder    = :reminder,
                project_id  = :project_id
            WHERE id = :id
        ");
        
        return $stmt->execute([
            ':id'          => $id,
            ':title'       => $data['title'],
            ':event_date'  => $data['event_date'],
            ':start_time'  => $data['start_time']  ?? null,
            ':end_time'    => $data['end_time']    ?? null,
            ':description' => $data['description'] ?? null,
            ':reminder'    => $data['reminder']    ?? null,
            ':project_id'  => $data['project_id']  ?? null,
        ]);
    }

    /**
     * Tandai bahwa notifikasi H-1 sudah dikirim untuk event ini
     */
    public function markReminderH1Sent($eventId)
    {
        $stmt = $this->conn->prepare("
            UPDATE events
            SET reminder_h1_sent = 1
            WHERE id = ?
        ");
        return $stmt->execute([$eventId]);
    }

    /**
     * Ambil event besok yang belum dikirim notifikasi H-1-nya
     */
    public function getScheduledForTomorrow()
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM events
            WHERE status = 'scheduled'
            AND event_date = DATE_ADD(CURDATE(), INTERVAL 1 DAY)
            AND reminder_h1_sent = 0
            ORDER BY start_time ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM events WHERE user_id = ? ORDER BY event_date ASC, start_time ASC");
        $stmt->execute([$user_id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
