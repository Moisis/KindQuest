<?php

interface DonationAdapterInterface {
    public function processDonation(float $amount, int $eventID, int $userID);
}
