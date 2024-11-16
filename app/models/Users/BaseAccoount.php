<?php

declare(strict_types=1);
abstract class BaseAccount{

    protected AuthStrategy $auth;
    protected int $userID;
    protected string $userName;
    protected string $password;
    protected string $accountType;  
    
    public abstract function setAuthStrategy (AuthStrategy $auth) : void;

    public abstract function login(array $credentials): bool;

    public abstract function register(array $data): bool;


    public static function getUserById(int $accountId): ?array {
        $query = "SELECT account_id, username, account_type FROM Account WHERE account_id = ?";
        $result = run_select_query($query, [$accountId]);

        if ($result !== null && !empty($result)) {
            return $result[0];

        } else {
            
            return null;
        }
    }


    public function getUserId(): int {
        return $this->userID;
    }


    

    

}











