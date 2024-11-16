<?php


class AboutController {
    public function index() {
        session_regenerate_id();

        require_once dirname(__DIR__) . "/views/about.php";        
    }


}

?>
