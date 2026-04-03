<?php

class TaskController extends Controller {

    public function index() {
        $this->view('pages/tasks', [
            'title' => 'Tasks'
        ]);
    }
}