<?php
require_once "DonationStrategy.php";
require_once "VisaDonationAdapter.php";


class DonationByVisa implements DonationStrategy {

    private VisaDonationAdapter $adapter;

    public function __construct() {
        $this->adapter = new VisaDonationAdapter();
    }

    public function donate(float $amount, int $eventID, int $userID) {
        $this->adapter->processDonation($amount, $eventID, $userID);
    }
}