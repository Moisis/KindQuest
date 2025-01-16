<?php

require_once __DIR__."/../Badge.php";
require_once __DIR__."/../BadgeDecorator.php";
//when user donates a single 100 pounds donation he gets this badge
class DonationMilestoneBadge extends BadgeDecorator{

    
    public function __construct(Badge $badgeToDecorate, int $userID){
        parent::__construct($badgeToDecorate, $userID, BadgesTypes::DonoChamp->value);
        $this->badgeList[] = $this; //add the badge to the list
    }

    public function getPoints(){

        $bonusPoints = 0;
        if($this->badgeCount >= 5){
            $bonusPoints += 50;
        }

        return $this->badge->getPoints() + $this->badgePoints * $this->badgeCount + $bonusPoints;
    }
}