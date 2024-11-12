<?php

require_once __DIR__ . '/../../core/Database.php';

class JoinAsVolunteer implements JoinStrategy{
    public function join($event_id, $account_id): void{
        $query = "insert into event_registration(event_id, account_id, role) values (?,?,1)";
        run_insert_query($query, [$event_id, $account_id]);
    }
}

?>