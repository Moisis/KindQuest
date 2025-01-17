<?php

declare(strict_types=1);

require_once(__DIR__ . "/Auth/AuthStrategy.php");
require_once(__DIR__ . "/Auth/AdminAuth.php");
require_once(__DIR__ . "/Auth/IndividualAuth.php");
require_once(__DIR__ . "/Auth/OrganizationAuth.php");


class AuthStrategyFactory{
    public function __construct(){

    }
    function createStrategy(String $user_type){
        if ($user_type === 'individual' || $user_type == "Individual") {
            return new IndividualAuth();
        } elseif ($user_type === 'organization' || $user_type == "Organization") {
            return new OrganizationAuth();
        }elseif ($user_type === 'admin' || $user_type == "Admin") {
            return new AdminAuth();
        }
    }
}