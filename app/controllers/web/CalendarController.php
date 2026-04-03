<?php

class CalendarController extends Controller {

    public function index() {
        $this->view('pages/calendar', [
            'title' => 'Calendar'
        ]);
    }
}