<?php

require_once "DonationStrategy.php";

class DonationByFawry implements DonationStrategy{

    public function donate(float $amount, int $eventID, int $userID){
        run_query("INSERT INTO Donation(amount, event_id,account_id,donation_method)
                   VALUES ($amount, $eventID, $userID,2)");
    }

}