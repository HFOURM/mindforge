<?php

class AnalyticController extends Controller {

    public function index() {
        $this->view('pages/analytics', [
            'title' => 'Analytics'
        ]);
    }
}