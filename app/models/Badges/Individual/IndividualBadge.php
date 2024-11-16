<?php

require_once __DIR__."/../../../../core/Database.php";
abstract class IndividualBadge{
    protected int $badgeCount;
    protected string $badgeName = "Nothing";

    protected int $badgePoints = 0;

    protected int $badgeID;

    public abstract function getPoints();

    public function getName(){
        return $this->badgeName;
    }


}