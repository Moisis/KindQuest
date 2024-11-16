<?php

declare(strict_types=1);
class Organization extends Client{


    public function __construct(int $accountId) {
        
        $query = "SELECT a.account_id, a.username, a.password, a.email, at.account_type_name 
                  FROM Account a 
                  JOIN Account_Types at ON a.account_type_id = at.account_type_id 
                  WHERE a.account_id = ?";
        $result = run_select_query($query, [$accountId]);

        // If account exists, set the attributes, else do not create the object
        if ($result !== null && !empty($result)) {
            $this->userID = $result[0]['account_id'];  
            $this->userName = $result[0]['username'];  
            $this->password = $result[0]['password'];  
            $this->email = $result[0]['email'];        
            $this->accountType = $result[0]['account_type_name'];  

            
            $this->auth = new IndividualAuth();
        } else {
            
            return null;
        }
    }


    public function donate(float $amount, Event $event){
        

    }

    public function createEvent(){
        
    }

    public function sponsorEvent(){
        
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
}