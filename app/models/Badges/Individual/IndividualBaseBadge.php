<?php

require_once "IndividualBadge.php";
class IndividualBaseBadge extends IndividualBadge{

    public function __construct(){
        $this->badgeID = 1;
        $badgeData = run_select_query("SELECT badge_points from Badge where badge_id = $this->badgeID")->fetch_assoc();
        $this->badgePoints = $badgeData['badge_points'];
        $this->badgeName = $badgeData['badge_name'];
        $this->badgeCount = $badgeData['badge_count'];
    }

    public function getPoints(){
        return $this->badgePoints * $this->badgeCount;
    }

}