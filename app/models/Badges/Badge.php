<?php
require_once "Individual/IndividualBaseBadge.php";
require_once "Individual/JoinMilestoneBadge.php";
require_once __DIR__."/../../../core/Database.php";

class Badge{


    public static function getBadesByUserID($userID){
        $badgeData = run_select_query("SELECT * from Account_Badges WHERE account_id = $userID");
        $badge = new IndividualBaseBadge();
        if ($badgeData->num_rows > 0) {
            while ($singleBadgeData = $badgeData->fetch_assoc()) {
                switch($singleBadgeData["badge_id"]){
                    case 2:
                        $badge = new JoinMilestoneBadge($badge, $singleBadgeData['badge_count']);
                        break;
                }
            }
        }
        return $badge;


    }

}