<?php

class BaseBadge extends Badge{

    public function __construct(){
        $this->badgeID = 1;
        $badgeData = run_select_query("SELECT * from Badge where badge_id = $this->badgeID")->fetch_assoc();
        //echo $badgeData;
        $this->badgePoints = $badgeData['badge_points'];
        $this->badgeName = $badgeData['badge_name'];
        $this->badgeCount = 1;
    }

    public function getPoints(){
        return $this->badgePoints * $this->badgeCount;
    }

}