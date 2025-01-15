<?php
require_once __DIR__."/../BadgeDecorator.php";
require_once __DIR__."/../Badge.php";

//When User Joins 2 Events, he gats this badge
class JoinMilestoneBadge extends BadgeDecorator{

    public function __construct(Badge $badgeToDecorate, int $userID){
        parent::__construct($badgeToDecorate, $userID, BadgesTypes::VolunChamp->value);
    }

    public function getPoints(){
        return $this->badge->getPoints() + $this->badgePoints * $this->badgeCount;
    }

}