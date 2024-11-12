<?php

require_once 'DonationController.php';
class DonationProcess
{
    function donationProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventID = $_POST['event_id'];
            $accountID = $_POST['account_id'];
            $amount = $_POST['amount'];
            $donationMethod = $_POST['donation_method'];
            echo ($_POST['donation_method']);


            $donationData = [
                'event_id' => $eventID,
                'account_id' => $accountID,
                'amount' => $amount,
                'donation_method' => $donationMethod
            ];

            // Pass the array to the donate function
            DonationController::donate($donationData);
        }
    }
}