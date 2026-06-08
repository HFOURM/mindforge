<?php

require_once BASE_PATH . '/app/models/Event.php';
require_once BASE_PATH . '/app/helpers/Response.php';

class EventController extends Controller
{
    private $eventModel;

    public function __construct()
    {
        $this->eventModel = new Event();
    }

    public function index()
    {
        $user = $_SERVER['user'];
        $userId = is_array($user) ? $user['id'] : $user->id;

        $events = $this->eventModel->getByUser($userId);
        
        Response::success('Success fetch events', $events);
    }

    public function getByDate($date)
    {
        $user = $_SERVER['user'];
        $userId = is_array($user) ? $user['id'] : $user->id;

        $events = $this->eventModel->getEventsByDate($userId, $date);
        
        Response::success('Success fetch events by date', $events);
    }
}
