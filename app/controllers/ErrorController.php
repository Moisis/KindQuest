<?php

class ErrorController {
    public function index() {
        // Render 404 error page
        require_once dirname(__DIR__) . '/views/404.php';
    }

    public function suspended() {
        // Render 401 error page
        require_once dirname(__DIR__) . '/views/Suspended.php';
    }
}
?>