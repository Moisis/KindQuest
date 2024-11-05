<?php

require "DonationStrategy.php";

class Donation{

    private DonationStrategy $donationStrategy;

    public function __construct($newDonationStrategy){
        $this->donationStrategy = $newDonationStrategy;
    }

    public function setDonationStrategy(DonationStrategy $newDonationStrategy){
        $this->donationStrategy = $newDonationStrategy;
    }

    public function makeDonation(float $amount, int $eventID, int $userID){
        $this->donationStrategy->donate($amount, $eventID, $userID);
    }

}