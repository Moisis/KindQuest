<?php

require_once dirname(__DIR__, 1).'/models/Events/Event.php';
require_once dirname(__DIR__, 1).'/models/Events/Fundraising.php';
require_once dirname(__DIR__, 1).'/models/Events/NonVirtualEvent.php';
require_once dirname(__DIR__, 1).'/enums/EventTypes.php';

class EventController {
    public function index() {
        session_regenerate_id();

        $user_id = $this->getUserId();
        $user_data = $user_id ? $this->getUserDetails($user_id) : null;

        $fundraising_events = $this->getAllEvents();
        $onSite_events = NonVirtualEvent::getAllNonVirtualEvents();
        require_once dirname(__DIR__, 1)."/views/events.php";
    }

    public function getAllEvents() {
        return Fundraising::getAllFundraising();
    }

    

    public static function getUserDetails($user_id): ?array
    {
        return BaseAccount::getUserById($user_id);
    }

    public static function getUserId(): ?int
    {
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            return BaseAccount::getAccountId($username);
        }
        return null;
    }

    public function joinEvent() {
        // Not yet implemented
    }
}

?>