<?php

require_once 'IListener.php';
require_once "app\models\Users\BaseAccount.php";

class EmailListener implements IListener{

    // protected int $account_id = 1;

    public function __construct($subject){
        $subject->subscribe($this);
    }

    public function update($data){
        //Email the person with data
        $emailNotifier = new EmailNotifier();
        $emailNotifier->sendDonationReceipt($_SESSION['email'], $_SESSION["username"], $data);
        // echo "<script>alert(\"Email Sent Successfuly\")</script>";

    }

}