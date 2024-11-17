<?php

require_once  dirname(__DIR__, 1).'/models/Events/Event.php';
require_once  dirname(__DIR__, 1).'/models/Events/Fundraising.php';
require_once  dirname(__DIR__, 1).'/models/Events/NonVirtualEvent.php';

require_once  dirname(__DIR__, 1).'/enums/EventTypes.php';


class EventCreationController{

    public function index(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            require_once dirname(__DIR__,1).'/views/event_creation.php';
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
             $event = null;
            if ($_POST['event_type_id'] == EventTypes::Fundraising->value){
                $this->createFundraisingEvent($event, $_POST['event_type_id'], $_POST['event_name'], 
                $_POST['event_description'], $_POST['start_date'], 
                $_POST['end_date'], $_POST['event_goal']);
            }
        }
    }


    private function createFundraisingEvent($event, $event_type_id, $event_name, $event_description, $start_date, $end_date, $event_goal){
       

        Fundraising::insertFundraiser(
            1, // $_SESSION['user_id']
            $event_name,
            $event_description,
            "0", //should be removed for fundraisers
            $start_date,
            $end_date,
            $event_type_id,
            $event_goal);
            
//        echo "Done";
        header("Location: /");
        }

    }