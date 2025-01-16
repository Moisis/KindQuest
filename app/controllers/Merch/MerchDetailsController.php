<?php

require_once dirname(__DIR__, 2) . '/models/Product.php';

class MerchDetailsController {
    public function index($id) {
        session_regenerate_id();
        $merch = Product::getProductById($id);
        require_once dirname(__DIR__, 2) . '/views/Merch/merch_details_page.php';
    }

}