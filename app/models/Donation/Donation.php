<?php
require_once "DonationStrategy.php";
require_once __DIR__."/../../../core/Database.php";
class Donation{

    private DonationStrategy $donationStrategy;

    public function __construct($newDonationStrategy){
        $this->donationStrategy = $newDonationStrategy;
    }

    public function setDonationStrategy(DonationStrategy $newDonationStrategy){
        $this->donationStrategy = $newDonationStrategy;
    }

    public function makeDonation(float $amount, int $eventID, int $userID):bool{
        $this->donationStrategy->donate($amount, $eventID, $userID);
        return true;
    }

    public static function getAllDonations(){
        /*
        donationID
        userID
        username
        account type
        eventID
        eventName
        amount
        donationMethod
        */

        $result = run_select_query("SELECT * FROM Donation ORDER BY donation_date DESC");
        $donations = [];
        while($row = $result->fetch_assoc()){
            $res = run_select_query("SELECT event_name FROM event where event_id = ?", [$row['event_id']]);
            $eventName = ($res->fetch_assoc())['event_name'];

            $res = run_select_query("SELECT username, account_type_id FROM account where account_id = ?", [$row['account_id']]);
            $user = $res->fetch_assoc();
            $username = $user['username'];
            $accountType = $user['account_type_id'];

            $donations[] = [
                'donationID' => $row['donation_id'],
                'userID' => $row['account_id'],
                'username' => $username,
                'account_type' => $accountType,
                'eventID' => $row['event_id'],
                'eventName' => $eventName,
                'amount' => $row['amount'],
                'donationMethod' => $row['donation_method']
            ];
        }
        return $donations;

    }

    public static function getAllDonationsByUser(int $accountID){
        return run_select_query("SELECT * FROM Donation WHERE account_id = $accountID");
    }

    public static function getAllDonationsToEvent(int $eventID){
        return run_select_query("SELECT * FROM Donation WHERE event_id = $eventID");
    }

    public static function getAllDonationsByMethod(int $donationMethod){
        return run_select_query("SELECT * FROM Donation WHERE donation_method = $donationMethod");
    }    

}