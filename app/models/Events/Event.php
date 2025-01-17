<?php
declare(strict_types= 1);
require_once __DIR__ . '/../../../core/Database.php';
require_once 'Fundraising.php';



abstract class Event{

    protected string $event_name;
    protected int $event_id;
    protected string $description;
    protected string $start_date;
    protected string $end_date;
    protected string $registration_time;
    protected int $event_type_id;

    
    public static function get_event($id){
        $query = "select * from event where event_id = $id";
        $result = run_select_query($query);
        $first_row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) == 0){
            return 0;
        }else if($first_row["event_type_id"] == 1){
            //fundraising
//            echo "hi";
//            echo $first_row['event_name'];
            $query = "select * from fundraising where event_id = $id";
            $result1 = run_select_query($query);
            $result1_first_row = mysqli_fetch_assoc($result1);
            $event = new Fundraising($id,
                $first_row["event_name"], $first_row["desc"], $first_row["registration_date"],
                $first_row["start_date"],$first_row["end_date"], $first_row["event_type_id"], 
                $result1_first_row["goal"]
            );
            return $event;
                // string $event_name, string $description, string $start_date, string $end_date, int $event_type_id, int $goal
        }else if($first_row["event_type_id"] == 2){
            //non virtual event
            $query = "select * from non_virtual_events where event_id = $id";
            $result1 = run_select_query($query);
            $result1_first_row = mysqli_fetch_assoc($result1);
            $event = new NonVirtualEvent($id,
                $first_row["event_name"], $first_row["desc"], $first_row["registration_date"],
                $first_row["start_date"],$first_row["end_date"], $first_row["event_type_id"], 
                $result1_first_row["location"],
                 $result1_first_row["vol_required"],
                  $result1_first_row["org_required"],
                   $result1_first_row["current_volunteers"],
                    $result1_first_row["current_organizers"]
            );
            return $event;
        }
    }

    public function __construct(int $eventID, string $event_name, string $description,string $reg_time, string $start_date, string $end_date, int $event_type_id){
        $this->event_id = $eventID;
        $this->event_name = $event_name;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->registration_time = $reg_time;
        $this->event_type_id = $event_type_id;

    }
    public static function insertEvent($user_id, string $event_name, string $description,string $registration_time, string $start_date, string $end_date, int $event_type_id){

        $query = "INSERT INTO event (creator_id, event_name, `desc`,created_at ,`start_date`, end_date, registration_date, event_type_id) VALUES (?, ?, ?, NOW(),  ?, ?, ?, ?)";
        run_insert_query($query, [$user_id,$event_name, $description, $start_date, $end_date, $registration_time, $event_type_id]);
    }
    public static function getAllRegisteredEvents($userId) {
        $events = [];
        
        // SQL query to get basic event data and join with event_registration table
        $query = "SELECT e.*, er.*, f.goal, n.location, n.vol_required, n.org_required, n.current_volunteers, n.current_organizers
                  FROM event e
                  JOIN event_registration er ON e.event_id = er.event_id
                  LEFT JOIN fundraising f ON e.event_id = f.event_id
                  LEFT JOIN non_virtual_events n ON e.event_id = n.event_id
                  WHERE er.account_id = $userId";
        
        $result = run_select_query($query);
        
        while ($row = mysqli_fetch_assoc($result)) {
            // Check event type and create appropriate event object
            if ($row["event_type_id"] == 1) {
                // Fundraising event
                $event = new Fundraising(
                    $row['event_id'], 
                    $row['event_name'], 
                    $row['desc'], 
                    $row['registration_date'], 
                    $row['start_date'], 
                    $row['end_date'], 
                    $row['event_type_id'], 
                    $row['goal']
                );
            } elseif ($row["event_type_id"] == 2) {
                // NonVirtualEvent
                $event = new NonVirtualEvent(
                    $row['event_id'], 
                    $row['event_name'], 
                    $row['desc'], 
                    $row['registration_date'], 
                    $row['start_date'], 
                    $row['end_date'], 
                    $row['event_type_id'], 
                    $row['location'], 
                    $row['vol_required'], 
                    $row['org_required'], 
                    $row['current_volunteers'], 
                    $row['current_organizers']
                );
            }
            
            // Add the event to the events array
            $events[] = $event;
        }
        
        return $events;
    }
    
    
    
    
    
    // public function getEventName(): string{
    //     $query = "SELECT event_name From event Where event_id = ?";
    //     $result = run_select_query($query, [$this->event_id]);
    //     return $result !== null ? $result : '';;
    // }
    public function modifyEventName($n): bool {
        $query = "UPDATE event SET event_name = ? WHERE (event_id = ?)";
        $result = run_update_query($query, [$n, $this->event_id]);
        return $result !== null ? $result : false;
    }
    public function modifyEnd_Date($d, $event_id): bool {
        $query = "UPDATE event SET end_date = ? WHERE (event_id = ?)";
        $result = run_update_query($query, [$d, $event_id]);
        return $result !== null ? $result : false;
    }
    public function getOrganiser($event_id): string {
        $query = "SELECT username FROM account WHERE ((account_id = (SELECT account_id FROM event_registration WHERE event_id = ?))";
        $result = run_select_query($query, [$event_id]);
        return $result !== null ? $result :"";
    }
    
    
    public function modifyevent_type_id($d, $event_id): bool {
        $query = "UPDATE event SET event_type_id = ? WHERE (event_id = ?)";
        $result = run_update_query($query, [$d, $event_id]);
        return $result !== null ? $result : false;
    }
    public function searchEventName($name): array {
        $query = "SELECT event_name FROM event WHERE event_name = ?";   
        $result = run_select_query($query, [$name]);
        $eventNames = [];
        foreach ($result as $row) {
            $eventNames[] = $row['event_name'];
        }
    
        return $eventNames;
    }

    public static function getEventsCountByCreator($org_id){
        $query = "SELECT COUNT(*) FROM EVENT WHERE creator_id = ?";
        $result = run_select_query($query, [$org_id]);
        $count = $result->fetch_array()[0];
        return $count; 
    }

    public static function getEventsCreationDateByID($eventID){
        $query = "SELECT created_at FROM EVENT WHERE event_id = ?";
        $result = run_select_query($query, [$eventID]);
        if($result->num_rows > 0){
            return explode(" ", $result->fetch_assoc()["created_at"])[0];
        }
        else{
            return null;
        }
    }

    public static function getFirstEventCreationDateByUserID($creatorID){
        $query = "SELECT created_at FROM EVENT WHERE creator_id = ? ORDER BY created_at ASC";
        $result = run_select_query($query, [$creatorID]);
        if($result->num_rows > 0){
            $date = $result->fetch_assoc()["created_at"];
            if($date != null){
                return explode(" ", $date)[0];
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }

    public function getEventName(): string
    {
        return $this->event_name;
    }

    public function getEventId(): int
    {
        return $this->event_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }


    public function getStartDate(): string
    {
        return $this->start_date;
    }

    public function getEndDate(): string
    {
        return $this->end_date;
    }

    public function getRegistrationTime(): string
    {
        return $this->registration_time;
    }

    public function getEventTypeId(): int
    {
        return $this->event_type_id;
    }
    
}
