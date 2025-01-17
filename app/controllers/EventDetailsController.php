<?php

require_once  dirname(__DIR__, 1).'/models/Events/Event.php';
require_once  dirname(__DIR__, 1).'/models/JoinStrategy.php';
require_once  dirname(__DIR__, 1).'/models/JoinAsVolunteer.php';
require_once  dirname(__DIR__, 1).'/models/JoinAsOrganizer.php';



class EventDetailsController{
    
    public function index($id){
        $current_event = Event::get_event((int)$id);
        require_once dirname(__DIR__, 1)."/views/event_details.php";
    }

    public function join_event($event_id) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userId = $_SESSION["ID"];
            $join_strategy = null;
    
            if ($_POST['role'] == 1) {
                $join_strategy = new JoinAsVolunteer();
                $join_strategy->join($event_id, $userId);
            } else if ($_POST['role'] == 2) {
                $join_strategy = new JoinAsOrganizer();
                $join_strategy->join($event_id, $userId);
            }
    
            // Redirect to the event details page to refresh the data
            header("Location: /event/$event_id");
            exit();
        }
    }
    

}