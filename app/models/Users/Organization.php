<?php

declare(strict_types=1);
class Organization extends Client{


    public function __construct() {

        $this->auth = new OrganizationAuth();

    }


    public function donate(float $amount, Event $event){
        

    }

    public function createEvent(){
        
    }

    public function sponsorEvent(){
        
    }
}