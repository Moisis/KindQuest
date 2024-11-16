<?php
require_once "Individual/IndividualBaseBadge.php";
require_once "Individual/JoinMilestoneBadge.php";
require_once "Individual/DonationMilestoneBadge.php";
require_once __DIR__."/../../../core/Database.php";

class Badge{


    public static function getBadgesByUserID($userID){
        $badgeData = run_select_query("SELECT * from Account_Badges WHERE account_id = $userID");
        $names = array();
        $badge = new IndividualBaseBadge();
        if ($badgeData->num_rows > 0) {
            while ($singleBadgeData = $badgeData->fetch_assoc()) {
                switch($singleBadgeData["badge_id"]){
                    case 2:
                        $badge = new JoinMilestoneBadge($badge, $userID);
                        break;
                    case 3:
                        $badge = new DonationMilestoneBadge($badge, $userID);
                        break;                        
                }
                $names[] = $badge->getName();
            }
        }
        $returnedBadgeData = [
            "names" => $names,
            "points" => $badge->getPoints()
        ];
        return $returnedBadgeData;
    }


    //Badge::getBadgesByUserID(_SESSION['id'])->getPoints()
    public static function addBadgeToUser($userID, $badgeID){
        $userBadgeCount = run_select_query("SELECT badge_count FROM Account_Badges where account_id = $userID AND badge_id = $badgeID");

        //if user doesn't have badge, give ... him the badge
        if($userBadgeCount->num_rows == 0){
            run_query("INSERT INTO Account_Badges(account_id,badge_id,badge_count) VALUES ($userID, $badgeID, 1)");

        }
        else{
            $NewBadgeCount = run_select_query("SELECT badge_count 
            from Account_Badges 
            where account_id = $userID AND badge_id = $badgeID")->fetch_assoc()["badge_count"] + 1;
            run_query("UPDATE Account_Badges SET badge_count = $NewBadgeCount WHERE account_id = $userID AND badge_id = $badgeID");
        }


    }

}