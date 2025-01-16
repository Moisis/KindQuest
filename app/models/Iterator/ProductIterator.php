<?php

require_once "IIterator.php";

class ProductIterator implements IIterator {
    private $productsCollection;
    private $position = 0;

    public function __construct(ProductCollection $productsCollection) {
        $this->productsCollection = $productsCollection;
    }

    public function hasNext(): bool {
        return $this->position < count($this->productsCollection->getItems());
    }

    public function next() {
        $items = $this->productsCollection->getItems();
        if ($this->hasNext()) {
            return $items[$this->position++];
        }
        return null;
    }

}