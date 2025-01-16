<?php

require_once __DIR__."/../BadgeDecorator.php";

class FirstEventBadge extends BadgeDecorator{

    public function __construct(Badge $badgeToDecorate, int $userID){
        parent::__construct($badgeToDecorate, $userID, BadgesTypes::NewOrganizer->value);
        $this->badgeList[] = $this; //add the badge to the list
    }

    public function getPoints(){

        $bonusPoints = 0;
        $firstEventCreationDate = Event::getFirstEventCreationDateByUserID($this->badgeOwnerID);
        if($firstEventCreationDate != null){
            $month = date("m", strtotime($firstEventCreationDate));
            $day = date("d", strtotime($firstEventCreationDate));
            if($month == 1 && $day == 1){ //if event created on 1st of jan
                $bonusPoints = 30;
            }
        }

        return $this->badge->getPoints() + $this->badgePoints * $this->badgeCount + $bonusPoints;
    }
}