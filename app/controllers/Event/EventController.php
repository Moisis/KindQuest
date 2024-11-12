<?php

require_once  dirname(__DIR__, 2).'/models/Events/Event.php';
require_once  dirname(__DIR__, 2).'/models/Events/Fundraising.php';
require_once  dirname(__DIR__, 2).'/models/Events/NonVirtualEvent.php';

require_once  dirname(__DIR__, 2).'/enums/EventTypes.php';

class EventController {
    public function index() {

        require_once dirname(__DIR__, 2)."/views/events.php";
    }

    public function createEvent()
    {
        $event = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['event_type_id'] == EventTypes::Fundraising->value) {
                $event = new Fundraising(
                    $_POST['event_name'],
                    $_POST['event_description'],
                    $_POST['start_date'],
                    $_POST['end_date'],
                    $_POST['event_type_id'],
                    $_POST['event_goal']);
            }
            $event->insertEvent(1); // $_SESSION['user_id']
        }
    }

    public function getAllEvents()
    {

    }

    public function joinEvent(){

    }
}

?>
