<?php

require_once dirname(__DIR__, 1).'/models/Events/Event.php';
require_once dirname(__DIR__, 1).'/models/Events/Fundraising.php';
require_once dirname(__DIR__, 1).'/models/Events/NonVirtualEvent.php';
require_once dirname(__DIR__, 1).'/enums/EventTypes.php';

class EventController {
    public function index() {
        session_regenerate_id();

        $fundraising_events = $this->getAllEvents();
        require_once dirname(__DIR__, 1)."/views/events.php";
    }

    public function getAllEvents() {
        return Fundraising::getAllFundraising();
    }

    public function joinEvent() {
        // Not yet implemented
    }
}

?>