<?php
declare(strict_types=1);
require "../Events/Event.php";


abstract class Client extends BaseAccount{


    //event class will be implemented later
    abstract function donate(float $amount, Event $event);

}