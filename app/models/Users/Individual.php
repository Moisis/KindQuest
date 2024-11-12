<?php
declare(strict_types = 1);
require_once __DIR__ . '/../../../core/Database.php';
require_once __DIR__. "Client.php";


class Individual extends Client{

    public function __construct(){

        $this->auth = new IndividualAuth();

    }

    public function donate(float $amount, Event $event){

    }
  


    //wait till fundraising class is implemented
    public function createFundraising(){

    }




}