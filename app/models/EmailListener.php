<?php

require_once 'IListener.php';
class EmailListener implements IListener{

    public function __construct($subject){
        $subject->subscribe($this);
    }

    public function update($data){
        //Email the person with data
    }

}