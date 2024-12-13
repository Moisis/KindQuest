<?php

interface IDonation{
    public function makeDonation(float $amount, int $eventID, int $userID);

    public function setDonationStrategy(DonationStrategy $newDonationStrategy);

    


}