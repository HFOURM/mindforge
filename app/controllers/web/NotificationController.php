<?php

class NotificationController extends Controller
{
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

    public function latest()
    {
        header('Content-Type: application/json');

        require_once "../app/models/Notification.php";

        $notificationModel = new Notification();

        $notifications = $notificationModel->getLatestByUser(
            $_SESSION['user']['id'],
            10
        );

        echo json_encode([
            'success' => true,
            'data' => $notifications
        ]);

        exit;
    }

    
    public function unread()
    {
        header('Content-Type: application/json');

        require_once "../app/models/Notification.php";

        $notificationModel = new Notification();

        $notifications = $notificationModel->getUnread(
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

        $total = $notificationModel->countUnread(
            $_SESSION['user']['id']
        );

        echo json_encode([
            'success' => true,
            'total' => $total
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
                'success' => false,
                'message' => 'Notification ID is required'
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

    public function delete()
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

        $success =
            $notificationModel->delete(
                $id,
                $_SESSION['user']['id']
            );

        echo json_encode([
            'success' => $success
        ]);

        exit;
    }

    public function clearAll()
    {
        header('Content-Type: application/json');

        require_once "../app/models/Notification.php";

        $notificationModel = new Notification();

        $success = $notificationModel->clearAll(
            $_SESSION['user']['id']
        );

        echo json_encode([
            'success' => $success
        ]);

        exit;
    }

    public function deleteSelected()
    {
        header('Content-Type: application/json');

        require_once "../app/models/Notification.php";

        $notificationModel = new Notification();

        $ids = $_POST['ids'] ?? [];

        if (empty($ids)) {

            echo json_encode([
                'success' => false
            ]);

            exit;
        }

        $success =
            $notificationModel->deleteSelected(
                $ids,
                $_SESSION['user']['id']
            );
        echo json_encode([
            'success' => $success
        ]);

        exit;
    }

}