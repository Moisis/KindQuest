<?php

require_once __DIR__."/../../enums/badgesTypes.php";
abstract class BadgeDecorator extends Badge{
    protected Badge $badge;

    public function __construct(Badge $badgeToDecorate, int $userID, int $badgeID){
        $this->badge = $badgeToDecorate;
        $this->badgeID = $badgeID;
        $this->badgeOwnerID = $userID;
        $badgeData = run_select_query("SELECT * from Badge where badge_id = $this->badgeID")->fetch_assoc();
        $this->badgePoints = $badgeData['badge_points'];
        $this->badgeName = $badgeData['badge_name'];
        $badgeCountRow = run_select_query("SELECT badge_count 
        from Account_Badges 
        where account_id = $userID AND badge_id = $this->badgeID")->fetch_assoc();
        if($badgeCountRow != null){
            $this->badgeCount = $badgeCountRow["badge_count"];
        }
        else{
            $this->badgeCount = 0;
        }
    }

    public function setIndividual(Badge $badge){
        $this->badge = $badge;
    }


}