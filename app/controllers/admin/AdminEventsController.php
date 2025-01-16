<?php


class AdminEventsController
{
    public function index() {
        session_regenerate_id();

        require_once dirname(__DIR__, 2) . "/views/admin/admin_dash.php";
    }
}