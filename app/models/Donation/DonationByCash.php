<?php

require_once "DonationStrategy.php";
require_once "CashDonationAdapter.php";

class DonationByVisa implements DonationStrategy {

    private CashDonationAdapter $adapter;

    public function __construct() {
        $this->adapter = new CashDonationAdapter();
    }

    public function donate(float $amount, int $eventID, int $userID) {
        $this->adapter->processDonation($amount, $eventID, $userID);
    }
}