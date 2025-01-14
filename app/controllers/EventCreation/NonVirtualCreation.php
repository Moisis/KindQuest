<?php


require_once __DIR__."../../models/Events/NonVirtualEvent.php";


class NonVirtualCreation extends EventCreationTemplate{

    private NonVirtualEvent $nonVirtEvent;

    public function __construct(NonVirtualEvent $event, $org_id){
        $this->nonVirtEvent = $event;
        $this->org_id = $org_id;
        $this->setEvent($event); //set parent event for event validation
    }
    public function validateEventChild(): bool{
        if($this->nonVirtEvent->get_required_volunteers() <= 0){
            return false;
        }
        return true;
    }

    public function insertEventIntoDB(){
        $this->nonVirtEvent->insertIntoDB($this->org_id);
    }
    
}