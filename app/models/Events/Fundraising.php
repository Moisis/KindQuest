<?php

declare(strict_types= 1);

class Fundraising extends Event {

    private int $goal;
    private function __construct(int $goal) {
        $this->goal = $goal;
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