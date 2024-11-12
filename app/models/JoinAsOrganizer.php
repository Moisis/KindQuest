<?php
require_once __DIR__ . '/../../core/Database.php';
// declare(strict_types= 1);

class JoinAsOrganizer implements JoinStrategy{
    public function join($event_id, $account_id): void{
        
        $query = "insert into event_registration(event_id, account_id, role) values (?,?,2)";
        run_insert_query($query, [$event_id, $account_id]);
    }
}

?>