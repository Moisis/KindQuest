<?php
require_once "IndividualBadgeDecorator.php";


//When User Joins 2 Events, he gats this badge
class JoinMilestoneBadge extends IndividualBadgeDecorator{

    public function __construct(IndividualBadge $badgeToDecorate, int $userID){
        $this->individualBadge = $badgeToDecorate;
        $this->badgeID = 2;
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