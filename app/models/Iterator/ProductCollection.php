<?php
require_once "ProductIterator.php";
require_once "IIterableCollection.php";
//require_once "../Product.php";
require_once dirname(__DIR__, 1).'/Product.php';
class ProductCollection implements IIterableCollection {
    private $products = [];

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function createIterator(): ProductIterator {
        return new ProductIterator($this);
    }

    public function getItems(): array {
        return $this->products;
    }
}