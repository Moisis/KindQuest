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
            //charity
        }else if($first_row["event_type_id"] == 1){
            //workshop
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

        $query = "INSERT INTO event (creator_id, event_name, `desc`, `start_date`, end_date, registration_date, event_type_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        run_insert_query($query, [$user_id,$event_name, $description, $start_date, $end_date, $registration_time, $event_type_id]);
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
