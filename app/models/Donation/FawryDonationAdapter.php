<?php

require_once "DonationAdapterInterface.php";

class FawryDonationAdapter implements DonationAdapterInterface {

    public function processDonation(float $amount, int $eventID, int $userID) {
        // Simulate voucher code validation
        $voucherCode = $this->generateVoucherCode();
        run_query("INSERT INTO Donation(amount, event_id, account_id, donation_method, donation_date, voucher_code)
                   VALUES ($amount, $eventID, $userID, 2, NOW(), '$voucherCode')");
    }

    private function generateVoucherCode(): string {
        // Generate a random voucher code for simulation
        return strtoupper(bin2hex(random_bytes(4)));
    }
}
