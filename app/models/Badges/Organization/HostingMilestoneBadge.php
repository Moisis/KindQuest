<?php

require_once __DIR__."/../BadgeDecorator.php";
class HostingMilestoneBadge extends BadgeDecorator{

    public function __construct(Badge $badgeToDecorate, int $userID){
        parent::__construct($badgeToDecorate, $userID, BadgesTypes::OrganizeChamp->value);
    }

    public function getPoints(){


        return $this->badge->getPoints() + $this->badgePoints * $this->badgeCount;
    }

}