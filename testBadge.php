<?php

require_once "app/models/Badges/Individual/IndividualBaseBadge.php";
require_once "app/models/Badges/Individual/JoinMilestoneBadge.php";
require_once "app/models/Badges/Badge.php";
/*$badge = new IndividualBaseBadge();
$points = $badge->getPoints();
echo "Points of base = $points<br>";
$badge2 = new JoinMilestoneBadge($badge,1);
$points = $badge2->getPoints();
echo "Points After 1st Decoration = $points";
$badge3 = new JoinMilestoneBadge($badge2,1);
$points = $badge3->getPoints();
echo "Points After 1st Decoration = $points";*/
$badge = Badge::getBadesByUserID(1);
$points = $badge->getPoints();
echo "<br><p>Badge Points = $points</p>";