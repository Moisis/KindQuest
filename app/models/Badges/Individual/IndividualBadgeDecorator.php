<?php
require "../../Users/Individual.php";
declare(strict_types=1);
abstract class IndividualBadgeDecorator extends Individual{
    
    private Individual $individual;

    public function setIndividual(Individual $newIndividual){
        $individual = $newIndividual;
    }


}