<?php

require_once "IDonation.php";
require_once "Donation.php";

function isUserSuspendedStub(int $userID){
    if($userID % 2 == 0){
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