<?php

require_once __DIR__ . '/../../core/Database.php';

class JoinAsVolunteer implements JoinStrategy {
    public function join($event_id, $account_id): void {
        // Check if the user is already registered as a volunteer for the event
        $check_query = "SELECT COUNT(*) AS count FROM event_registration WHERE event_id = ? AND account_id = ? AND role = 1";
        $result = run_select_query($check_query, [$event_id, $account_id])->fetch_assoc();

        // If the user is already a volunteer, do not proceed
        if ($result['count'] > 0) {
            echo "You are already registered as a volunteer for this event.";
            return;
        }

        // Insert into Event_Registration table
        $query = "INSERT INTO event_registration(event_id, account_id, role) VALUES (?, ?, 1)";
        run_insert_query($query, [$event_id, $account_id]);

        // Update the current volunteers count in Non_Virtual_Events
        $update_query = "UPDATE Non_Virtual_Events SET current_volunteers = current_volunteers + 1 WHERE event_id = ?";
        run_insert_query($update_query, [$event_id]);
    }
}



?>