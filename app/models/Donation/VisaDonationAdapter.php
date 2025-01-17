<?php

require_once "DonationAdapterInterface.php";

class VisaDonationAdapter implements DonationAdapterInterface {

    public function processDonation(float $amount, int $eventID, int $userID) {
        // Simulate a bank approval process
        $bankApproval = $this->simulateBankApproval();
        if ($bankApproval) {
            // Generate a unique transaction ID
            $transactionID = $this->generateTransactionID();

            // Insert the donation record into the database
            run_query("INSERT INTO Donation(amount, event_id, account_id, donation_method, donation_date, transaction_id)
                       VALUES ($amount, $eventID, $userID, 1, NOW(), '$transactionID')");
        } else {
            throw new Exception("Visa payment failed: Bank approval not granted.");
        }
    }

    private function simulateBankApproval(): bool {
        // Randomly approve or deny for simulation
        return rand(0, 1) === 1;
    }

    private function generateTransactionID(): string {
        // Generate a unique transaction ID (e.g., using a combination of timestamp and random values)
        return uniqid('TXN-', true);
    }
}