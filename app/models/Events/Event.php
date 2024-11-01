<?php

declare(strict_types= 1);

abstract class Event{

    private string $event_name;
    private int $event_id;
    private string $description;
    private string $start_date;
    private string $end_date;
    private string $registration_time;
    private bool $sponsored;
}

?>