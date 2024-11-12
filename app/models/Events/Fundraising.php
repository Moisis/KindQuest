<?php

require_once "Event.php";

class Fundraising extends Event {

    private int $goal;
    public function __construct(string $event_name, string $description, string $start_date, string $end_date, int $event_type_id, int $goal) {
        parent::__construct($event_name, $description, $start_date, $end_date, $event_type_id);
        $this->goal = $goal;
    }

    public function insertEvent($userID): bool {
        $this->event_id = run_select_query("SHOW TABLE STATUS LIKE 'Event'")->fetch_assoc()["Auto_increment"];
        //echo ($this->event_id);
        parent::insertEvent($userID);
        $query = "INSERT INTO fundraising (event_id, goal) VALUES (?, ?)";
        return run_insert_query($query, [$this->event_id, $this->goal]);
    }

    public function getCurrDonations(): int {
        $currDonations = 0;
        $query = "SELECT amount FROM donation WHERE (event_id = ?)";
        $result = run_select_query($query, $this->event_id);
        foreach ($result as $row) {
            $currDonations += $row['amount'];
        }
        return $currDonations;
    }
    public function setCurrDonations(): void {
        $amount = $this->getCurrDonations();
        $this->goal -= $amount;
    }

    public function getGoal(): int {
    
        return $this->goal;
    }
    public static function getAllFundraising(){
        $query = "SELECT * from fundraising inner join event on fundraising.event_id = event.event_id";
        $result = run_select_query($query);
        // return $result;

        $fundraising_events = [];

        foreach ($result as $row) {
            $fundraising_events[] = new Fundraising(
                $row["event_name"],
                $row["desc"],
                $row["start_date"],
                $row["end_date"],
                $row["event_type_id"],
                $row["goal"],
            );
        }

        return $fundraising_events;
    }
}


?>