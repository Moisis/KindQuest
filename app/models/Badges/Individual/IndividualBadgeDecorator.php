<?php
require_once "IndividualBadge.php";
//require __DIR__."/../../../../core/Database.php";

abstract class IndividualBadgeDecorator extends IndividualBadge{
    
    protected IndividualBadge $individualBadge;


    public function setIndividual(IndividualBadge $newIndividualBadge){
        $this->individualBadge = $newIndividualBadge;
    }

}