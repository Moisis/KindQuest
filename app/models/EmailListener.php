<?php

require_once 'IListener.php';
class EmailListener implements IListener{

    protected int $account_id = 1;

    public function __construct($subject){
        $subject->subscribe($this);
    }

    public function update($data){
        //Email the person with data
    }

}