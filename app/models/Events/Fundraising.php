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

}


?>