<?php

class SettingController extends Controller {

    public function index() {
        $user = $_SESSION['user'];

        $this->view('pages/setting', [
            'title' => 'Settings',
            'user' => $user
        ]);
    }

    public function update() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $userId = $_SESSION['user']['id'];

        require_once "../app/models/User.php";
        $userModel = new User();

        $userModel->update($userId, $name, $email);

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;

        header("Location: /mindforge/public/settings");
}
}