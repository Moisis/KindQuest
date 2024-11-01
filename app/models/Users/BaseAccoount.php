<?php

declare(strict_types=1);
abstract class BaseAccount{
    private int $userID;
    private string $userName;
    private string $password;    

    abstract static function login(string $userName, string $password);

}











