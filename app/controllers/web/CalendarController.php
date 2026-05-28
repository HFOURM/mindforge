<?php

class CalendarController extends Controller {

    public function index() {
    // 1. Load model Event, bukan Task lagi
    require_once "../app/models/Event.php";
    $eventModel = new Event();

    // 2. Ambil data event berdasarkan user yang login (Pastikan method getByUser ada di model Event)
    $eventsRaw = $eventModel->getByUser($_SESSION['user']['id']);

    $events = [];

    // 3. Ambil parameter bulan dan tahun aktif dari URL (default ke bulan/tahun sekarang)
    $currentMonth = $_GET['month'] ?? date('n');
    $currentYear = $_GET['year'] ?? date('Y');

    foreach ($eventsRaw as $event) {
        // Gunakan 'event_date' sesuai struktur tabel events Anda
        $day = date('j', strtotime($event['event_date']));
        $month = date('n', strtotime($event['event_date']));
        $year = date('Y', strtotime($event['event_date']));

        // Kelompokkan event berdasarkan hari jika bulan & tahunnya cocok
        if ($month == $currentMonth && $year == $currentYear) {
            $events[$day][] = $event;
        }
    }

    // 4. Lempar data 'events' ke view kalender
    $this->view('pages/calendar', [
        'events' => $events
    ]);
}

    public function store()
    {

        require_once "../app/models/Event.php";
        $eventModel = new Event();

        $eventModel->create([
            'user_id' => $_SESSION['user']['id'],
            'title' => $_POST['title'],
            'event_date' => $_POST['event_date'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'description' => $_POST['description']
        ]);

        header("Location: /mindforge/public/calendar");
    }
}