<?php

require_once  dirname(__DIR__, 1).'/models/Events/Event.php';
require_once  dirname(__DIR__, 1).'/models/Events/Fundraising.php';
require_once  dirname(__DIR__, 1).'/models/Events/NonVirtualEvent.php';

require_once  dirname(__DIR__, 1).'/enums/EventTypes.php';

require_once __DIR__."EventCreation/FundraiserCreation.php";
require_once __DIR__."EventCreation/NonVirtualCreation.php";

class EventCreationController{

    public function index(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            require_once dirname(__DIR__,1).'/views/event_creation.php';
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if ($_POST['event_type_id'] == EventTypes::Fundraising->value){
                $this->createFundraisingEvent( $_POST['event_type_id'], $_POST['event_name'], 
                $_POST['event_description'], $_POST['start_date'], 
                $_POST['end_date'], $_POST['event_goal']);
            }
            else if ($_POST['event_type_id'] == EventTypes::NonVirtual->value){
                //echo "UserID is $userID";
                $nonVirtEvent = new NonVirtualEvent(
                    1,
                    $_POST["event_name"],
                    $_POST["event_description"],
                    "10/10/2002",
                    $_POST["start_date"],
                    $_POST["end_date"],
                    $_POST["event_type_id"],
                    $_POST["event_location"],
                    $_POST["vol_req"],
                    $_POST["org_req"]
                );

                $nonVirtTemplate = new NonVirtualCreation($nonVirtEvent, $_SESSION["ID"]);

                $nonVirtTemplate->createEvent();
                header("Location: /");
            }
        }
    }


    private function createFundraisingEvent($event_type_id, $event_name, $event_description, $start_date, $end_date, $event_goal){
       


        $fundraising = new Fundraising(
            1, //set event ID to anything, it doesn't matter here
            $event_name,
            $event_description,
            "0", //should be removed for fundraisers
            $start_date,
            $end_date,
            $event_type_id,
            $event_goal);

        $fundCreateTemplate = new FundraiserCreation($fundraising, $_SESSION["ID"]);

        $fundCreateTemplate->createEvent();


//        echo "Done";
        header("Location: /");
        }

    }