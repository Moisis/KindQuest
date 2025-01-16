<?php

require_once "app/models/Donation/DonationByCash.php";
require_once "app/models/Donation/Donation.php";

$dono = new Donation(new DonationByCash());
echo get_class($dono);