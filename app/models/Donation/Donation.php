<?php
require "DonationStrategy.php";
require_once __DIR__."/../../../core/Database.php";
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

    public static function getAllDonations(){
        return run_select_query("SELECT * FROM Donation");
    }

    public static function getAllDonationsByUser(int $accountID){
        return run_select_query("SELECT * FROM Donation WHERE account_id = $accountID");
    }

    public static function getAllDonationsToEvent(int $eventID){
        return run_select_query("SELECT * FROM Donation WHERE event_id = $eventID");
    }

    public static function getAllDonationsByMethod(int $donationMethod){
        return run_select_query("SELECT * FROM Donation WHERE donation_method = $donationMethod");
    }    

}