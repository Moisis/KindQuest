<?php

declare(strict_types=1);

class Admin extends BaseAccount{


    public function __construct(string $userName, string $password){

        $this->userID = rand(1,999);
        $this->userName = $userName;
        $this->password = $password;
        $this->auth = new AdminAuth();

    }


    public function setAuthStrategy(AuthStrategy $auth): void
    {
        $this->auth = $auth;
    }

    public function login(array $credentials): bool {

        return $this->auth->login($credentials);

    }

    public function register(array $data): bool
    {
        return $this->auth->register($data);
    } 

}


