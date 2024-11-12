<?php

require_once  dirname(__DIR__, 1).'/models/Events/Event.php';
require_once  dirname(__DIR__, 1).'/models/JoinStrategy.php';
require_once  dirname(__DIR__, 1).'/models/JoinAsVolunteer.php';
require_once  dirname(__DIR__, 1).'/models/JoinAsOrganizer.php';



class EventDetailsController{

    public function index($id){
        $event = Event::get_event($id);
        require_once dirname(__DIR__, 1)."/views/event_creation.php";
    }

    public function join_event($event_id){

        /*
        ROLES: 
            volunteer: 1,
            organizer: 2
        */

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $userId = 1;
            $join_strategy = null;

            if($_POST['role'] == 1){
                $join_strategy = new JoinAsVolunteer();
                $join_strategy->join($event_id, $userId);
                echo "ok";
            }else if($_POST['role'] == 2){
                $join_strategy = new JoinAsOrganizer(); 
                $join_strategy->join($event_id, $userId);
                echo "ok";
            }
        }
    }

}