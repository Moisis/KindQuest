<?php
class ProfileController {
    public function index() {

        session_regenerate_id();
        require_once dirname(__DIR__) . "/views/profile.php";
    }


    public function logout()
    {
        $_SESSION['logged'] = false;
        session_unset();
        session_destroy();
        header("Location: /");
        exit();
    }


}

?>
