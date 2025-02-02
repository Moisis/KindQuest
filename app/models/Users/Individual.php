<?php
declare(strict_types = 1);
require_once __DIR__ . '/../../../core/Database.php';
require_once "app\models\Users\Client.php";


class Individual extends Client{

    public function __construct(int $accountId) {
        
        $query = "SELECT a.account_id, a.username, a.password, a.email, at.account_type_name 
                  FROM Account a 
                  JOIN Account_Types at ON a.account_type_id = at.account_type_id 
                  WHERE a.account_id = ?";
        $result = run_select_query($query, [$accountId]);

        // Fetch the result as an associative array
        $resultArray = $result->fetch_assoc();

        // If account exists, set the attributes, else do not create the object
        if ($resultArray !== null && !empty($resultArray)) {
            $this->userID = $resultArray['account_id'];  
            $this->userName = $resultArray['username'];  
            $this->password = $resultArray['password'];  
            $this->email = $resultArray['email'];        
            $this->accountType = $resultArray['account_type_name'];  

            $this->auth = new IndividualAuth();
            $this->suspended = false;
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


    public function joinEventAsVolunteer(NonVirtualEvent $event): string {
        // Check if the user is already registered for the event
        $checkQuery = "
            SELECT 1 
            FROM Event_Registration 
            WHERE event_id = :event_id AND account_id = :account_id
        ";
        $existingEntry = run_select_query($checkQuery, [
            ':event_id' => $event->getEventId(),
            ':account_id' => $this->userID
        ]);
    
        if (!empty($existingEntry)) {
            return "User is already registered for the event."; 
        }
    
        
        try {
            $result = $event->add_Volunteer($this->userID);
    
            if ($result === "maximum_reached") {
                return "Maximum number of volunteers has been reached."; 
            }
    
            return "Successfully registered for the event."; 
        } catch (Exception $e) {
            
            return "Failed to join event: " . $e->getMessage();
        }
    }
    


}