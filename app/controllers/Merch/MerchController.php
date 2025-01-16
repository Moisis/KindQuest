<?php

require_once dirname(__DIR__, 2) . '/models/Product.php';

class MerchController {
    public function index() {
        session_regenerate_id();

        $products = Product::getProducts();
        require_once dirname(__DIR__, 2) . '/views/Merch/merch_page.php';
    }

}

