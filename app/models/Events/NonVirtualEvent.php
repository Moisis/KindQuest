<?php

declare(strict_types= 1);

class NonVirtualEvent extends Event{

    private string $location;
    private int $volunteers_required;
    private int $organizers_required;
    private int $current_volunteers;
    private int $current_organizers;

    public function __construct(string $location, int $volunteers_required, int $current_volunteers,
                                 int $current_organizers, int $organizers_required) {
        $this->location = $location;
        $this->volunteers_required = $volunteers_required;
        $this->organizers_required = $organizers_required;
        $this->current_volunteers = $current_volunteers;
        $this->current_organizers = $current_organizers;
    }
    public function insertNonVirtualEvent(): bool{
        $query = "INSERT INTO non_virtual_events(event_id, `location`, volunteers_required,
                                                 current_volunteers, current_organizers) 
                                                 VALUES (?, ?, ?, ?, ?)";
        return run_insert_query($query,[$this->event_id, $this->location,
                                                       $this->volunteers_required, 
                                                       $this->organizers_required, 
                                                       $this->current_volunteers, 
                                                       $this->current_organizers]);
    }

    


}


?>