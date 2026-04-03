<?php

class ProjectController extends Controller {

    public function index() {
        $this->view('pages/project', [
            'title' => 'Projects'
        ]);
    }
}