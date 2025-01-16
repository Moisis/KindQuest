<?php
require_once "BaseBadge.php";


require_once __DIR__."/../../../core/Database.php";
require_once __DIR__."/../Badges/Individual/JoinMilestoneBadge.php";
require_once __DIR__."/../Badges/Individual/DonationMilestoneBadge.php";
require_once __DIR__."/../Badges/Organization/FirstEventBadge.php";
require_once __DIR__."/../Badges/Organization/HostingMilestoneBadge.php";
require_once __DIR__."/../Badges/BaseBadge.php";
class Badge{

    protected int $badgeCount;
    protected string $badgeName;

    protected int $badgePoints = 0;

    protected int $badgeID;

    protected int $badgeOwnerID;

    protected $badgeList = array();

    public function getPoints(){
        return $this->badgePoints;
    }

    public function getName(){
        return $this->badgeName;
    }

    public function getBadgeList(){
        return $this->badgeList;
    }



    
    public static function getBadgesByUserID($userID){
        $badgeData = run_select_query("SELECT * from Account_Badges WHERE account_id = $userID");
        $badge = new BaseBadge();
        if ($badgeData->num_rows > 0) {
            while ($singleBadgeData = $badgeData->fetch_assoc()) {
                switch($singleBadgeData["badge_id"]){
                    case 2:
                        $badge = new JoinMilestoneBadge($badge, $userID);
                        break;
                    case 3:
                        $badge = new DonationMilestoneBadge($badge, $userID);
                        break;        
                    case 4:
                        $badge = new FirstEventBadge($badge, $userID);
                        break;        
                    case 5:
                        $badge = new HostingMilestoneBadge($badge, $userID);
                        break;                                                
                }
            }
        }

        return $badge;
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