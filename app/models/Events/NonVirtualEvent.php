<?php
declare(strict_types= 1);
require_once 'Event.php';



class NonVirtualEvent extends Event{

    private string $location;
    private int $volunteers_required;
    private int $organizers_required;
    private int $current_volunteers=0;
    private int $current_organizers=0;

    public function __construct(
        int $event_id,
        string $event_name,
        string $description,
        string $registration_time,
        string $start_date,
        string $end_date,
        int $event_type_id,
        string $location,
        int $volunteers_required,
        int $organizers_required,
        int $current_volunteers=0,
        int $current_organizers=0
    ) {
        parent::__construct($event_id, $event_name, $description, $registration_time, $start_date, $end_date, $event_type_id);
        $this->location = $location;
        $this->volunteers_required = $volunteers_required;
        $this->organizers_required = $organizers_required;
        $this->current_volunteers = $current_volunteers;
        $this->current_organizers = $current_organizers;
    }



     public static function insertNonVirtualEvent(
        string $user_id,
        string $event_name,
        string $description,
        string $registration_time,
        string $start_date,
        string $end_date,
        int $event_type_id,
        string $location,
        int $volunteers_required,
        int $organizers_required,
        int $current_volunteers,
        int $current_organizers
    ): bool {
        // Get the next auto-incremented ID for the event
        $event_id = run_select_query("SHOW TABLE STATUS LIKE 'Event'")->fetch_assoc()["Auto_increment"];
        
        // Insert into the parent Event table
        parent::insertEvent($user_id, $event_name, $description, $registration_time, $start_date, $end_date, $event_type_id);
        
        // Insert into the NonVirtualEvents table
        $query = "
            INSERT INTO non_virtual_events (event_id, location, vol_required, org_required, current_volunteers, current_organizers)
            VALUES (?, ?, ?, ?, ?, ?)
        ";
        return run_insert_query($query, [$event_id, $location, $volunteers_required, $organizers_required, $current_volunteers, $current_organizers]);
    }

    public function insertIntoDB($user_id){
        $event_id = run_select_query("SHOW TABLE STATUS LIKE 'Event'")->fetch_assoc()["Auto_increment"];
        
        // Insert into the parent Event table
        parent::insertEvent($user_id, $this->event_name, $this->description, $this->registration_time, $this->start_date, $this->end_date, $this->event_type_id);
        
        // Insert into the NonVirtualEvents table
        $query = "
            INSERT INTO non_virtual_events (event_id, location, vol_required, org_required, current_volunteers, current_organizers)
            VALUES (?, ?, ?, ?, ?, ?)
        ";
        return run_insert_query($query, [$event_id, $this->location, $this->volunteers_required, $this->organizers_required, $this->current_volunteers, $this->current_organizers]);        
    }


    public function set_Volunteers_required(int $volunteers_required): void {
        $this->volunteers_required = $volunteers_required;
    
        $query = "
            UPDATE Non_Virtual_Events 
            SET vol_required = :vol_required 
            WHERE event_id = :event_id
        ";
        $result = run_update_query($query, [
            ':vol_required' => $volunteers_required,
            ':event_id' => $this->event_id
        ]);
    
        if (!$result) {
            throw new Exception("Failed to update volunteers required in the database.");
        }
    }
    
    public function set_organizers_required(int $organizers_required): void {
        $this->organizers_required = $organizers_required;
    
        // Update the organizers_required property in the database
        $query = "
            UPDATE Non_Virtual_Events 
            SET org_required = :org_required 
            WHERE event_id = :event_id
        ";
        $result = run_update_query($query, [
            ':org_required' => $organizers_required,
            ':event_id' => $this->event_id
        ]);
    
        if (!$result) {
            throw new Exception("Failed to update organizers required in the database.");
        }
    }


    public function set_currentVolunteers(int $v): void{
        $this->current_volunteers = $v;
    }
    public function get_currentVolunteers(): int{
        return $this->current_volunteers;
    }

    public function set_current_organizers(int $o): void{
        $this->current_organizers = $o;
    }


    public function get_current_organizers(): int{
        return $this->current_organizers;
    }

    public function get_required_volunteers(){
        return $this->volunteers_required;
    }
    public function get_location(){
        return $this->location;
    }
    public function get_required_organizers(){
        return $this->organizers_required;
    }
    public function isUserRegisteredToEvent($event_id, $user_id): bool {
        error_log("Checking registration: event_id={$event_id}, user_id={$user_id}");
    
        $query = "SELECT 1 FROM event_registration WHERE event_id = ? AND account_id = ?";
        $result = run_select_query($query, [$event_id, $user_id]);
    
        // Check if $result is a mysqli_result object and if it contains any rows
        $is_registered = ($result instanceof mysqli_result) && ($result->num_rows > 0);
        error_log("Query executed: {$query} with params: event_id={$event_id}, user_id={$user_id}");
        error_log("Query result: " . print_r($result, true));
        error_log("User registration status: " . ($is_registered ? "Registered" : "Not registered"));
    
        return $is_registered;
    }
    
    
    
    

    
    public function getVolunteers($event_id) {
        $query = "SELECT account_id FROM event_registration WHERE event_id = ? AND role = ?";
        $result = run_select_query($query, [$event_id, 'Volunteer']);
    
        if ($result === false) {
            // Log the error or display a message for debugging
            echo "Error retrieving volunteers list.<br>";
            return []; // Return an empty array to prevent foreach error
        }
    
        return $result;
    }
    
    
    public function add_Volunteer($account_id): string {
        if ($this->current_volunteers >= $this->volunteers_required) {
            return "maximum_reached"; 
        }
    
        // Prepare the query with named parameters
        $query = "
            INSERT INTO Event_Registration (event_id, account_id, role) 
            VALUES (:event_id, :account_id, :role)
        ";
        $result = run_insert_query($query, [
            ':event_id' => $this->event_id,
            ':account_id' => $account_id,
            ':role' => 'Volunteer'
        ]);
    
        
        if (!$result) {
            throw new Exception("Failed to add volunteer.");
        }
    
        // Update the internal counts
        $this->current_volunteers++;
        $this->volunteers_required--;
        $this->set_currentVolunteers($this->current_volunteers);
        $this->set_Volunteers_required($this->volunteers_required);
    
        return "success"; 
    }
    
    
    public function remove_Volunteer($account_id): void {
        if ($this->current_volunteers <= 0) {
            echo "No volunteers to remove.";
            return;
        }
    
        $query = "DELETE FROM event_registration WHERE event_id = ? AND account_id = ? AND `role` = ?";
        $result = run_delete_query($query, [$this->event_id, $account_id, 'Volunteer']);
        
        if (!$result) {
            echo "Failed to remove volunteer.";
            return;
        }
    
        
        $req = $this->volunteers_required++;
        $curr = $this->current_volunteers--;
        $this->set_currentVolunteers($curr);
        $this->set_Volunteers_required($req);
    }



    public function add_Organizer($account_id): string {
        // Check if the maximum number of organizers has been reached
        if ($this->current_organizers >= $this->organizers_required) {
            return "maximum_reached"; 
        }
    
        // Prepare the query with named parameters
        $query = "
            INSERT INTO Event_Registration (event_id, account_id, role) 
            VALUES (:event_id, :account_id, :role)
        ";
        $result = run_insert_query($query, [
            ':event_id' => $this->event_id,
            ':account_id' => $account_id,
            ':role' => 'Organizer'
        ]);
    
        // Handle query failure
        if (!$result) {
            throw new Exception("Failed to add organizer.");
        }
    
        // Update the internal counts
        $this->current_organizers++;
        $this->organizers_required--;
        $this->set_current_organizers($this->current_organizers);
        $this->set_organizers_required($this->organizers_required);
    
        return "success"; 
    }
    
    public static function getAllNonVirtualEvents(){
        $query = "SELECT * from non_virtual_events inner join event on non_virtual_events.event_id = event.event_id";
        $result = run_select_query($query);
        // return $result;

        $eventsCollection = new EventCollection();

        foreach ($result as $row) {
            $eventsCollection->addEvent(
                new NonVirtualEvent(
                    $row["event_id"],
                    $row["event_name"],
                    $row["desc"],
                    $row["registration_date"],
                    $row["start_date"],
                    $row["end_date"],
                    $row["event_type_id"],
                    $row["location"],
                    $row["vol_required"],
                    $row["org_required"],
                    $row["current_volunteers"],
                    $row["current_organizers"]
                )
            );
        }

        $iterator = $eventsCollection->createIterator();

        return $iterator;
    }

    
    

}


