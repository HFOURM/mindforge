<?php

class NotificationController extends Controller {

    public function getAll()
    {
        header('Content-Type: application/json');

        require_once "../app/models/Notification.php";

        $notificationModel = new Notification();

        $notifications = $notificationModel->getByUser(
            $_SESSION['user']['id']
        );

        echo json_encode([
            'success' => true,
            'data' => $notifications
        ]);

        exit;
    }

    public function unreadCount()
    {
        header('Content-Type: application/json');

        require_once "../app/models/Notification.php";

        $notificationModel = new Notification();

        $result = $notificationModel->countUnread(
            $_SESSION['user']['id']
        );

        echo json_encode([
            'success' => true,
            'total' => (int)$result['total']
        ]);

        exit;
    }

    public function markRead()
    {
        header('Content-Type: application/json');

        require_once "../app/models/Notification.php";

        $notificationModel = new Notification();

        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo json_encode([
                'success' => false
            ]);
            exit;
        }

        $success = $notificationModel->markAsRead($id);

        echo json_encode([
            'success' => $success
        ]);

        exit;
    }

    public function markAllRead()
    {
        header('Content-Type: application/json');

        require_once "../app/models/Notification.php";

        $notificationModel = new Notification();

        $success = $notificationModel->markAllRead(
            $_SESSION['user']['id']
        );

        echo json_encode([
            'success' => $success
        ]);

        exit;
    }
}