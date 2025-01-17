<?php
declare(strict_types=1);
require_once "app\models\Events\Event.php";
require_once "app\models\Users\BaseAccount.php";

abstract class Client extends BaseAccount{


    //event class will be implemented later
    abstract function donate(float $amount, Event $event);

}