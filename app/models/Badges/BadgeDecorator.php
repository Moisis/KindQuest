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
        $badgeCountRow = run_select_query("SELECT badge_count 
        from Account_Badges 
        where account_id = $userID AND badge_id = $this->badgeID")->fetch_assoc();
        if($badgeCountRow != null){
            $this->badgeCount = $badgeCountRow["badge_count"];
        }
        else{
            $this->badgeCount = 0;
        }
        $this->badgeName = $badgeData['badge_name']; //add badge Name and count


    }

    public function setIndividual(Badge $badge){
        $this->badge = $badge;
    }

    public function getName(){
        return $this->badge->getName() . "#" . $this->badgeName . "($this->badgeCount)";
    }

    public function getBadgeList(){
        $oldBadgeList = $this->badge->getBadgeList();
        $oldBadgeList[] = $this;
        return $oldBadgeList;
    }

    public function checkIfBadgeExistsAndIncrement($badge_class_name){
        $badgeList = $this->getBadgeList();
        foreach($badgeList as $badge){
            // echo "THis badge class name is " . get_class($badge);
            if(get_class($badge) == $badge_class_name){
                $badge->badgeCount += 1;
                return true;
            }
        }
        return false;
    }



}