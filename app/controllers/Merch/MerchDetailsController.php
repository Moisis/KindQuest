<?php
class MerchDetailsController {
    public function index() {
        session_regenerate_id();
        require_once dirname(__DIR__, 2) . '/views/Merch/merch_details_page.php';
    }

}