<?php

declare(strict_types=1);


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