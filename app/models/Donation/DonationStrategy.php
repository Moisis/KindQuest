<?php
declare(strict_types=1);
require __DIR__."/../../../core/Database.php";

interface DonationStrategy{



    public function donate(float $amount, int $eventID, int $userID);
}