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
        int $organizers_required
    ) {
        parent::__construct($event_id, $event_name, $description, $registration_time, $start_date, $end_date, $event_type_id);
        $this->location = $location;
        $this->volunteers_required = $volunteers_required;
        $this->organizers_required = $organizers_required;
    }



     public static function insertNonVirtualEvent(
        int $user_id,
        string $event_name,
        string $description,
        string $registration_time,
        string $start_date,
        string $end_date,
        int $event_type_id,
        string $location,
        int $volunteers_required,
        int $organizers_required
    ): bool {
        // Get the next auto-incremented ID for the event
        $event_id = run_select_query("SHOW TABLE STATUS LIKE 'Event'")->fetch_assoc()["Auto_increment"];
        
        // Insert into the parent Event table
        parent::insertEvent($user_id, $event_name, $description, $registration_time, $start_date, $end_date, $event_type_id);
        
        // Insert into the NonVirtualEvents table
        $query = "
            INSERT INTO non_virtual_events (event_id, location, vol_required, org_required)
            VALUES (?, ?, ?, ?)
        ";
        return run_insert_query($query, [$event_id, $location, $volunteers_required, $organizers_required]);
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
    public function searchVolunteers($name): bool{
        $query = "SELECT username FROM account WHERE account_id = (SELECT account_id FROM event_registration WHERE event_id = ? AND `role` = ?) ";
        $result = run_select_query($query,[$this->event_id, 'Volunteer']);
        return $result;
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
    
    
    
    

}


