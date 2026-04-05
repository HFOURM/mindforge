<?php

class DashboardController extends Controller {

    public function index() {
        $user = $_SESSION['user'];

        $this->view('pages/dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
        ]);
    }
}