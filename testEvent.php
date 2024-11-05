<?php
require_once "app/models/Events/Event.php";

$event = new Event("Gala","421","Dancing and song","2001-10-9","2001-10-11","2001-10-1",true) ;
$event->insertEvent();