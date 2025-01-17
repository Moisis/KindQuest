<?php

require_once __DIR__."/../BadgeDecorator.php";
class HostingMilestoneBadge extends BadgeDecorator{

    public function __construct(Badge $badgeToDecorate, int $userID){
        parent::__construct($badgeToDecorate, $userID, BadgesTypes::OrganizeChamp->value);
        $this->badgeList[] = $this; //add the badge to the list
    }

    public function getPoints(){
        $bonusPoints = intdiv($this->badgeCount, 2) * 10; //Award 10 points for each 2 badges created
        

        return $this->badge->getPoints() + $this->badgePoints * $this->badgeCount + $bonusPoints;
    }

}