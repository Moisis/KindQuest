<?php

require_once "app/models/Donation/DonationProxy.php";
require_once "app/models/Donation/DonationByVisa.php";

$donoProxy = new DonationProxy(new DonationByVisa());


$donoProxy->makeDonation(30, 1, 5);