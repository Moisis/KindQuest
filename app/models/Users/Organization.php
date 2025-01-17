<?php

declare(strict_types=1);
class Organization extends Client{


    public function __construct(int $accountId) {
        
        $query = "SELECT a.account_id, a.username, a.password, a.email, at.account_type_name 
                  FROM Account a 
                  JOIN Account_Types at ON a.account_type_id = at.account_type_id 
                  WHERE a.account_id = ?";
        $result = run_select_query($query, [$accountId])->fetch_assoc();

        // If account exists, set the attributes, else do not create the object
        if ($result !== null && !empty($result)) {
            $this->userID = $result[0]['account_id'];  
            $this->userName = $result[0]['username'];  
            $this->password = $result[0]['password'];  
            $this->email = $result[0]['email'];        
            $this->accountType = $result[0]['account_type_name'];  

            
            $this->auth = new OrganizationAuth();
            $this->suspended = false;
        } else {
            
            throw new Exception("Account not found.");
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


public function joinEventAsOrganizer(NonVirtualEvent $event): string {
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
        // Attempt to add the user as an organizer
        $result = $event->add_Organizer($this->userID);

        if ($result === "maximum_reached") {
            return "Maximum number of organizers has been reached."; 
        }

        return "Successfully registered as an organizer for the event."; 
    } catch (Exception $e) {
        // Handle exceptions
        return "Failed to join event as organizer: " . $e->getMessage();
    }
}



}