<?php

require_once "DonationStrategy.php";
require_once "FawryDonationAdapter.php";

class DonationByFawry implements DonationStrategy{

    private FawryDonationAdapter $adapter;

    public function __construct() {
        $this->adapter = new FawryDonationAdapter();
    }

    public function donate(float $amount, int $eventID, int $userID) {
        $this->adapter->processDonation($amount, $eventID, $userID);
    }

}