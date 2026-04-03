<?php

class SettingController extends Controller {

    public function index() {
        $this->view('pages/setting', [
            'title' => 'Settings'
        ]);
    }
}