<?php

declare(strict_types=1);

class Admin extends BaseAccount{


    public function __construct(string $userName, string $password){

        $this->userID = rand(1,999);
        $this->userName = $userName;
        $this->password = $password;

    }

}


