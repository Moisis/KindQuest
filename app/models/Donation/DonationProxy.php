<?php

require_once "IDonation.php";
require_once "Donation.php";

function isUserSuspendedStub(int $userID){
    
    $query = "select suspended from account where account_id = ?";
    $result = run_select_query($query, [$userID]);
    $result = $result->fetch_assoc();

    
    if($result['suspended'] == 1){
        return true;
    }
    else{
        return false;
    }

}


class DonationProxy implements IDonation{

    private Donation $donation;

    public function __construct(DonationStrategy $donoStrat){
        $this->donation = new Donation($donoStrat);
    }


    
    public function setDonationStrategy(DonationStrategy $newDonationStrategy){
        $this->donation->setDonationStrategy($newDonationStrategy);
    }

    public function makeDonation(float $amount, int $eventID, int $userID){
        if(isUserSuspendedStub($userID) == true){
            echo "You are Suspended";
        }
        else{
            $this->donation->makeDonation($amount, $eventID, $userID);
        }
    }


}