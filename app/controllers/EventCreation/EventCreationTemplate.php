<?php

//Steps for event creation
//validate event data 
//validate specific event's data
//validate organization's authority (Optional)
//insert event into db
//send mail (Optiona)
//check and award badge
require_once __DIR__."../../models/Events/Event.php";
abstract class EventCreationTemplate{

    protected Event $event;
    public function validateEventData(){
        if(date($this->event->getStartDate()) > date($this->event->getEndDate()) ){
            return false;
        }

        return true;
    }

    abstract public function validateEventChild();

    abstract public function insertEventIntoDB();

    public function checkAndAwardBadge(){
        //code to check and award the organization a badge
    } 

    public function createEvent(){
        $validRes = $this->validateEventData() && $this->validateEventChild();
        if($validRes == true){
            $this->insertEventIntoDB();
            $this->checkAndAwardBadge();
        }
        return $validRes;
    }

    public function setEvent(Event $newEvent){
        $this->event = $newEvent;
    }


}