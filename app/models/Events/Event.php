<?php
declare(strict_types= 1);
require_once __DIR__ . '/../../../core/Database.php';



class Event{

    private string $event_name;
    private int $event_id;
    private string $description;
    private string $start_date;
    private string $end_date;
    private string $registration_time;
    private bool $sponsored;
    
    public function __construct(string $event_name, int $event_id, string $description, string $start_date, string $end_date, string $registration_time, bool $sponsored){
        $this->event_name = $event_name;
        $this->event_id = $event_id;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->registration_time = $registration_time;
        $this->sponsored = $sponsored;

    }
    public function insertEvent(): bool {
        // Prepare the SQL query with placeholders for the values
        $query = "INSERT INTO event (event_id, event_name, `desc`, `start_date`, end_date, registration_date, sponsored) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        // Use a prepared statement with `run_insert_query` or a similar function
        return run_insert_query($query, [$this->event_id, $this->event_name, $this->description, $this->start_date, $this->end_date, $this->registration_time, $this->sponsored]);
    }
    
    public function getEventName(): string{
        return $this->event_name;
    }
    public function setEventName(string $event_name): void{
        $this->event_name = $event_name;
    }
    public function searchEventName($name): array {
        $query = "SELECT event_name FROM EVENTS WHERE event_name = ?";   
        $result = run_select_query($query, [$name]);
        $eventNames = [];
        foreach ($result as $row) {
            $eventNames[] = $row['event_name'];
        }
    
        return $eventNames;
    }
    
}
