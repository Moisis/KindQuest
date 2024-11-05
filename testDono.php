<?php

require "app/Models/Donation/Donation.php";
require "app/Models/Donation/DonationByVisa.php";
require "app/Models/Donation/DonationByFawry.php";
require "app/Models/Donation/DonationByCash.php";
/*$dono = new Donation(new DonationByVisa());
$dono->makeDonation(500,1,1);
echo "Donated By VISA\n";
$dono->setDonationStrategy(new DonationByFawry());
$dono->makeDonation(500,1,1);
echo "Donated By FAWRY\n";
$dono->setDonationStrategy(new DonationByCash());
$dono->makeDonation(500,1,1);

$dono->setDonationStrategy(new DonationByFawry());
$dono->makeDonation(500,1,1);
echo "Donated By FAWRY\n";
$dono->setDonationStrategy(new DonationByCash());
$dono->makeDonation(500,1,1);
echo "Donated By CASH<br>";
*/
echo "All Donations<br>";
Donation::getAllDonations();
echo "All DOnations by user 1<br>";
Donation::getAllDonationsByUser(1);
echo "All Donations to event 1<br>";
Donation::getAllDonationsToEvent(1);
echo "All Donations by VISA<br>";
Donation::getAllDonationsByMethod(1);
echo "All Donations by FAWRY<br>";
Donation::getAllDonationsByMethod(2);
echo "All Donations by CASH<br>";
Donation::getAllDonationsByMethod(3);