<?php

declare(strict_types=1);
abstract class BaseAccount{

    protected AuthStrategy $auth;
    protected int $userID;
    protected string $userName;
    protected string $password;
    protected string $accountType;
    protected string $email;  
    
    public abstract function setAuthStrategy (AuthStrategy $auth) : void;

    public abstract function login(array $credentials): bool;

    public abstract function register(array $data): bool;


    public static function getUserById(int $accountId): ?array {
        
        $query = "SELECT account_id, username, email, account_type 
                  FROM Account 
                  WHERE account_id = ?";
        $result = run_select_query($query, [$accountId]);
    
        
        if ($result !== null && !empty($result)) {
            return $result[0];
        } else {
            return null; 
        }
    }
    



    public static function getUserByEmail(string $email): ?array {
        
        $query = "SELECT a.account_id, a.username, at.account_type_name AS account_type
                  FROM Account a
                  JOIN Account_Types at ON a.account_type_id = at.account_type_id
                  WHERE a.email = ?";
        
        $result = run_select_query($query, [$email]);
    
        
        if ($result !== null && !empty($result)) {
            return $result[0]; 
        } else {
            return null; 
        }
    }
    


    

    

}











