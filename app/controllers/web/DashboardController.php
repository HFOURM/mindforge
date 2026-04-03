<?php

class DashboardController extends Controller {

    public function index() {
        $this->view('pages/dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}