<?php

declare(strict_types=1);

require_once(__DIR__ . "/Auth/AuthStrategy.php");
require_once(__DIR__ . "/Auth/AdminAuth.php");
require_once(__DIR__ . "/Auth/IndividualAuth.php");
require_once(__DIR__ . "/Auth/OrganizationAuth.php");


class AuthLoginStrategyFactory{
    function createLoginStartegy(String $user_type){
        if ($user_type === 'individual') {
            return new IndividualAuth();
        } elseif ($user_type === 'organization') {
            return new OrganizationAuth();
        }elseif ($user_type === 'admin') {
            return new AdminAuth();
        }
    }
}