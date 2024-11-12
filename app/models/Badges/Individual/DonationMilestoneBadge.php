<?php

//when user donates a single 100 pounds donation he gets this badge
class DonationMilestoneBadge extends IndividualBadgeDecorator{

    
    public function __construct(IndividualBadge $badgeToDecorate, int $userID){
        $this->individualBadge = $badgeToDecorate;
        $this->badgeID = 3;
        $badgeData = run_select_query("SELECT * from Badge where badge_id = $this->badgeID")->fetch_assoc();
        $this->badgePoints = $badgeData['badge_points'];
        $this->badgeName = $badgeData['badge_name'];
        $this->badgeCount = run_select_query("SELECT badge_count 
        from Account_Badges 
        where account_id = $userID AND badge_id = $this->badgeID")->fetch_assoc()["badge_count"];
    }

    public function getPoints(){
        return $this->individualBadge->getPoints() + $this->badgePoints * $this->badgeCount;
    }
}