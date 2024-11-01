<?
require "../Events/Event.php";
declare(strict_types=1);

abstract class Client extends BaseAccount{


    //event class will be implemented later
    abstract function donate(float $amount, Event $event);

}