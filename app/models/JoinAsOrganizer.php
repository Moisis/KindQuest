<?php
require_once __DIR__ . '/../../core/Database.php';
// declare(strict_types= 1);

class JoinAsOrganizer implements JoinStrategy {
    public function join($event_id, $account_id): void {
        // Check if the user is already registered as an organizer for the event
        $check_query = "SELECT COUNT(*) FROM event_registration WHERE event_id = ? AND account_id = ? AND role = 2";
        $result = run_select_query($check_query, [$event_id, $account_id])->fetch_assoc();

        // If the user is already an organizer, do not proceed
        if ($result['COUNT(*)'] > 0) {
            echo "You are already registered as an organizer for this event.";
            return;
        }

        // Insert into Event_Registration table
        $query = "INSERT INTO event_registration(event_id, account_id, role) VALUES (?, ?, 2)";
        run_insert_query($query, [$event_id, $account_id]);

        // Update the current organizers count in Non_Virtual_Events
        $update_query = "UPDATE Non_Virtual_Events SET current_organizers = current_organizers + 1 WHERE event_id = ?";
        run_insert_query($update_query, [$event_id]);
    }
}



?>