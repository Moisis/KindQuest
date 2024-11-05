<?php

require "app/Models/Donation/Donation.php";
require "app/Models/Donation/DonationByVisa.php";
require "app/Models/Donation/DonationByFawry.php";
require "app/Models/Donation/DonationByCash.php";
$dono = new Donation(new DonationByVisa());
$dono->makeDonation(500,1,1);
echo "Donated By VISA\n";
$dono->setDonationStrategy(new DonationByFawry());
$dono->makeDonation(500,1,1);
echo "Donated By FAWRY\n";
$dono->setDonationStrategy(new DonationByCash());
$dono->makeDonation(500,1,1);
echo "Donated By CASH\n";
