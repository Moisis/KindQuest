<?php
declare(strict_types= 1);
require_once 'Event.php';



class NonVirtualEvent extends Event{

    private string $location;
    private int $volunteers_required;
    private int $organizers_required;
    private int $current_volunteers=0;
    private int $current_organizers=0;

    public function __construct(string $event_name, int $event_id, string $description, string $start_date, string $end_date, bool $sponsored,string $location, int $volunteers_required, int $organizers_required) {
        parent::__construct($event_name, $event_id, $description, $start_date, $end_date, $sponsored);
        $this->insertEvent();
        $this->location = $location;
        $this->volunteers_required = $volunteers_required;
        $this->organizers_required = $organizers_required;
    }
    public function insertNonVirtualEvent(): bool{
        $query = "INSERT INTO non_virtual_events(event_id, `location`, vol_required,
                                                 org_required) 
                                                 VALUES (?, ?, ?, ?)";
        return run_insert_query($query,[$this->event_id, $this->location,
                                                       $this->volunteers_required, 
                                                       $this->organizers_required]);
    }

    public function set_Volunteers_required(int $volunteers_required): void{
        $this->volunteers_required = $volunteers_required;
    }
    
    public function set_organizers_required(int $organizers_required): void{
        $this->organizers_required = $organizers_required;
    }
    public function set_currentVolunteers(int $v): void{
        $this->current_volunteers = $v;
    }
    public function get_currentVolunteers(): int{
        return $this->current_volunteers;
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
    
    
    public function add_Volunteer($account_id): void {
        if ($this->current_volunteers >= $this->volunteers_required) {
            echo "Cannot add more volunteers. Maximum reached.";
            return;
        }
    
        $query = "INSERT INTO event_registration (event_id, account_id, `role`) VALUES(?, ?, ?)";
        $result = run_insert_query($query, [$this->event_id, $account_id, 'Volunteer']);
        
        if (!$result) {
            echo "Failed to add volunteer.";
            return;
        }
    
        $req = $this->volunteers_required--;
        $curr = $this->current_volunteers++;
        $this->set_currentVolunteers($curr);
        $this->set_Volunteers_required($req);
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
    
    
    

}


