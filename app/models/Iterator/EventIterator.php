<?php
require_once "IIterator.php";
class EventIterator implements IIterator {
    private $eventsCollection;
    private $position = 0;

    public function __construct(EventCollection $eventsCollection) {
        $this->eventsCollection = $eventsCollection;
    }

    public function hasNext(): bool {
        return $this->position < count($this->eventsCollection->getItems());
    }

    public function next() {
        $items = $this->eventsCollection->getItems();
        if ($this->hasNext()) {
            return $items[$this->position++];
        }
        return null;
    }
}