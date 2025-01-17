<?php

require_once "DonationAdapterInterface.php";

class CashDonationAdapter implements DonationAdapterInterface {

    public function processDonation(float $amount, int $eventID, int $userID) {
        // Simulate issuing a receipt
        $receiptNumber = $this->generateReceipt();
        run_query("INSERT INTO Donation(amount, event_id, account_id, donation_method, donation_date, voucher_code)
                   VALUES ($amount, $eventID, $userID, 3, NOW(), '$receiptNumber')");
    }

    private function generateReceipt(): string {
        // Generate a random receipt number for simulation
        return strtoupper("REC" . rand(1000, 9999));
    }
}