<?php

require "../../../core/Database.php";
declare(strict_types = 1);

class Individual extends Client{



    public function donate(float $amount, Event $event){

    }
    public static function login($userName, $password){
        //authenticate data in database
        $queryRes = run_select_query("SELECT * FROM ACCOUNT 
        WHERE username = $userName AND password = $password");
          
        return $queryRes->num_rows == 0 ? false : true;
    }

    //wait till fundraising class is implemented
    public function createFundraising(){

    }




}