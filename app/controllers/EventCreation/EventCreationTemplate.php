<?php

//Steps for event creation
//validate event data 
//validate specific event's data
//validate organization's authority (Optional)
//insert event into db
//send mail (Optiona)
//check and award badge
require_once __DIR__."../../models/Events/Event.php";
require_once __DIR__."../../models/Badges/Badge.php";
require_once __DIR__."../../enums/badgesTypes.php";
abstract class EventCreationTemplate{

    protected Event $event;

    protected $org_id;
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
        //this check happens after inserting the new event
        //so we check if the new event count is divisible by 5 to award the badge

        $creatorEventCount = Event::getEventsCountByCreator($this->org_id);
        if ($creatorEventCount % 5 == 0){
            Badge::addBadgeToUser($this->org_id, BadgesTypes::OrganizeChamp->value);
        }

        //first event
        if($creatorEventCount == 1){
            Badge::addBadgeToUser($this->org_id, BadgesTypes::NewOrganizer->value);
        }

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