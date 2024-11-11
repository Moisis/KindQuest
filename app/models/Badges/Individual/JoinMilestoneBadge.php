<?php
require_once "IndividualBadgeDecorator.php";

class JoinMilestoneBadge extends IndividualBadgeDecorator{

    public function __construct(IndividualBadge $badgeToDecorate, int $badgeCount){
        $this->individualBadge = $badgeToDecorate;
        $this->badgeID = 2;
        $badgeData = run_select_query("SELECT * from Badge where badge_id = $this->badgeID")->fetch_assoc();
        $this->badgePoints = $badgeData['badge_points'];
        $this->badgeName = $badgeData['badge_name'];
        $this->badgeCount = $badgeCount;
    }

    public function getPoints(){
        return $this->individualBadge->getPoints() + $this->badgePoints * $this->badgeCount;
    }

}