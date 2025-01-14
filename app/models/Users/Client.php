<?php
declare(strict_types=1);
require "app\models\Events\Event.php";
require "app\models\BaseAccount.php";

abstract class Client extends BaseAccount{


    //event class will be implemented later
    abstract function donate(float $amount, Event $event);

}