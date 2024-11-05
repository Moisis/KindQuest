<?php

require_once "DonationStrategy.php";

class DonationByCash implements DonationStrategy{

    public function donate(float $amount, int $eventID, int $userID){
        run_query("INSERT INTO Donation(amount, event_id,account_id,donation_method,donation_date)
                   VALUES ($amount, $eventID, $userID,3,NOW())");
    }

}