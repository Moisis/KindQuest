<?php

require_once "app/models/Events/Event.php";

$x = Event::get_event(3);

// echo $x;
// for ($i = 0; $i < count($x); $i++) {
//     echo"<h1>" . $x[$i]->getEventName() . "</h1>";
//     echo $x[$i]->getGoal();
//     echo $x[$i]->getGoal();

// }


    echo"<h1>" . $x->getEventName() . "</h1>";
    echo $x->getGoal();
    // echo $y->getGoal();