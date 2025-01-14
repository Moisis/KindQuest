<?php

require_once  dirname(__DIR__, 2).'/models/Events/Fundraising.php';
require_once dirname(__DIR__, 2).'/models/Events/NonVirtualEvent.php';
require_once __DIR__.'/EventCreationTemplate.php';

class FundraiserCreation extends EventCreationTemplate{

    private Fundraising $fundraiser;

    public function __construct(Fundraising $fundraiser, $org_id){
        $this->fundraiser = $fundraiser;
        $this->org_id = $org_id;
        $this->setEvent($fundraiser); //set parent event for event validation
    }
    public function validateEventChild(): bool{
        if($this->fundraiser->getGoal() <= 0){
            return false;
        }
        return true;
    }

    public function insertEventIntoDB(){
        $this->fundraiser->insertFundToDB($this->org_id);
    }
    
}