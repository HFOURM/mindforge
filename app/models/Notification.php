<?php

require_once "../app/core/Database.php";

class Notification
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create(
        $userId,
        $title,
        $message,
        $type,
        $sourceId = null
    ) {
        $stmt = $this->conn->prepare("
            INSERT INTO notifications
            (
                user_id,
                title,
                message,
                type,
                source_id
            )
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $userId,
            $title,
            $message,
            $type,
            $sourceId
        ]);
    }

    public function createIfNotExists(
        $notificationKey,
        $userId,
        $title,
        $message,
        $type,
        $sourceId = null
    ) {
        $stmt = $this->conn->prepare("
            SELECT id
            FROM notifications
            WHERE notification_key = ?
            LIMIT 1
        ");

        $stmt->execute([$notificationKey]);

        if ($stmt->fetch()) {
            return false;
        }

        $stmt = $this->conn->prepare("
            INSERT INTO notifications
            (
                user_id,
                title,
                message,
                type,
                source_id,
                notification_key
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $userId,
            $title,
            $message,
            $type,
            $sourceId,
            $notificationKey
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

    public function getLatestByUser(
        $userId,
        $limit = 10
    ) {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM notifications
            WHERE user_id = ?
            ORDER BY created_at DESC
            LIMIT ?
        ");

        $stmt->bindValue(
            1,
            $userId,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            2,
            $limit,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnread($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM notifications
            WHERE user_id = ?
            AND is_read = 0
            ORDER BY created_at DESC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM notifications
            WHERE id = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countAll($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) AS total
            FROM notifications
            WHERE user_id = ?
        ");

        $stmt->execute([$userId]);

        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countUnread($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) AS total
            FROM notifications
            WHERE user_id = ?
            AND is_read = 0
        ");

        $stmt->execute([$userId]);

        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
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

    public function delete(
        $id,
        $userId
    )
    {
        $stmt = $this->conn->prepare("
            DELETE FROM notifications
            WHERE id = ?
            AND user_id = ?
        ");

        return $stmt->execute([
            $id,
            $userId
        ]);
    }

    public function clearAll($userId)
    {
        $stmt = $this->conn->prepare("
            DELETE FROM notifications
            WHERE user_id = ?
        ");

        return $stmt->execute([$userId]);
    }

    public function getByType(
        $userId,
        $type
    ) {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM notifications
            WHERE user_id = ?
            AND type = ?
            ORDER BY created_at DESC
        ");

        $stmt->execute([
            $userId,
            $type
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteOldNotifications(
        $days = 30
    ) {
        $stmt = $this->conn->prepare("
            DELETE FROM notifications
            WHERE created_at <
            DATE_SUB(
                NOW(),
                INTERVAL ? DAY
            )
        ");

        return $stmt->execute([$days]);
    }

    public function deleteSelected(
        array $ids,
        $userId
    )
    {
        if (empty($ids)) {
            return false;
        }

        $placeholders =
            implode(
                ',',
                array_fill(
                    0,
                    count($ids),
                    '?'
                )
            );

        $params = $ids;
        $params[] = $userId;

        $stmt = $this->conn->prepare("
            DELETE FROM notifications
            WHERE id IN ($placeholders)
            AND user_id = ?
        ");

        return $stmt->execute($params);
    }
}