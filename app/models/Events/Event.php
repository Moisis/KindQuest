<?php
declare(strict_types= 1);
require_once __DIR__ . '/../../../core/Database.php';



abstract class Event{

    private string $event_name;
    public int $event_id;
    private string $description;
    private string $start_date;
    private string $end_date;
    private string $registration_time;
    private bool $sponsored;
    

    public function __construct(string $event_name, int $event_id, string $description, string $start_date, string $end_date, bool $sponsored){
        $this->event_name = $event_name;
        $this->event_id = $event_id;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->registration_time = date('Y-m-d H:i:s');
        $this->sponsored = $sponsored;

    }
    public function insertEvent(): bool {

        $query = "INSERT INTO event (event_id, event_name, `desc`, `start_date`, end_date, registration_date, sponsored) VALUES (?, ?, ?, ?, ?, ?, ?)";
        return run_insert_query($query, [$this->event_id, $this->event_name, $this->description, $this->start_date, $this->end_date, $this->registration_time, $this->sponsored]);
    }
    
    public function getEventName(): string{
        $query = "SELECT event_name From event Where event_id = ?";
        $result = run_select_query($query, [$this->event_id]);
        return $result !== null ? $result : '';;
    }
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
    
    
    public function modifySponsored($d, $event_id): bool {
        $query = "UPDATE event SET sponsored = ? WHERE (event_id = ?)";
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
    
}
