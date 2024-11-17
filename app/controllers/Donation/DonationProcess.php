<?php

require_once 'DonationController.php';
class DonationProcess
{
    function donationProcess()
    {
        $user_id = $this->getUserId();
        $user_data = $this->getUserDetails($user_id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventID = $_POST['event_id'];
            $accountID = $user_data['account_id'];
            $amount = $_POST['amount'];
            $donationMethod = $_POST['donation_method'];
//            echo ($_POST['donation_method']);


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

    public static function getUserDetails($user_id): ?array
    {
        return BaseAccount::getUserById($user_id);
    }

    public static function getUserId(): ?int
    {
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            return BaseAccount::getAccountId($username);
        }
        return null;
    }

}