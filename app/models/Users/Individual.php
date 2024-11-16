<?php
declare(strict_types = 1);
require_once __DIR__ . '/../../../core/Database.php';
require_once __DIR__. "Client.php";


class Individual extends Client{

    public function __construct(int $accountId) {
        // Query to get account details and account type name from the Account_Types table
        $query = "SELECT a.account_id, a.username, a.password, at.account_type_name 
                  FROM Account a 
                  JOIN Account_Types at ON a.account_type_id = at.account_type_id 
                  WHERE a.account_id = ?";
        $result = run_select_query($query, [$accountId]);

        // If account exists, set the attributes, else do not create the object
        if ($result !== null && !empty($result)) {
            $this->userID = $result[0]['account_id'];  // Set the user ID
            $this->userName = $result[0]['username'];  // Set the user name
            $this->password = $result[0]['password'];  // Set the password
            $this->accountType = $result[0]['account_type_name'];  // Set the account type name

            // Initialize the auth strategy for the Individual class
            $this->auth = new IndividualAuth();
        } else {
            // If the account does not exist, return null or handle accordingly
            return null;
        }
    }

    public function register(array $credentials): bool {

        return$this->auth->register($credentials);
    }
   


    public function login(array $credentials): bool {


        return$this->auth->login($credentials);
    }


    public function setAuthStrategy (AuthStrategy $auth) : void {

        $this->auth = $auth;

}

    public function donate(float $amount, Event $event){

    }
  


    //wait till fundraising class is implemented
    public function createFundraising(){

    }


}