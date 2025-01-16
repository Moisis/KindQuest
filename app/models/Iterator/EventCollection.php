<?php
require_once "EventIterator.php";
//require_once "../Events/Event.php";
require_once dirname(__DIR__, 1).'/Events/Event.php';

class EventCollection implements IIterableCollection {
    private $events = [];

    public function addEvent(Event $event) {
        $this->events[] = $event;
    }

    public function createIterator() {
        return new EventIterator($this);
    }

    public function getItems(): array {
        return $this->events;
    }
}