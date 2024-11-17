<?php


class AdminController
{
    public function index() {
        session_regenerate_id();

        require_once dirname(__DIR__) . "/views/admin_dash.php";
    }
}
