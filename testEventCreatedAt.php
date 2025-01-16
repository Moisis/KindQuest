<?php

require_once "app/models/Events/Event.php";


$created_at = Event::getEventsCreationDateByID(2);
$dateCreate = date_create($created_at);
$nowDate = date_create("20-1-2025");
$subRes = date_diff($dateCreate, $nowDate);

$subRes = $subRes->days;

echo "$subRes";