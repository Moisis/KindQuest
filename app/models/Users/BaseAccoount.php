<?php

declare(strict_types=1);
require_once __DIR__ . "/../../../core/Database.php";
require __DIR__ ."/../DonoData.php";
require __DIR__ ."/../EmailListener.php";
abstract class BaseAccount{

    protected AuthStrategy $auth;
    protected int $userID;
    protected string $userName;
    protected string $password;
    protected string $accountType;
    protected string $email;  
    protected bool $suspended;
    public abstract function setAuthStrategy (AuthStrategy $auth) : void;

    public abstract function login(array $credentials): bool;

    public abstract function register(array $data): bool;


    /*
        DB Table(account_id, notification_for, preference)
        NotificationFor:
            donation
            joined event
            gained badge

        preference:
            email
            sms
    */

    public static function getPreferencesObserver(int $notification_for, String $username){
        $id = BaseAccount::getAccountId($username);
        $res = null;
        $subject = null;
        switch($notification_for){
            case 1:
                $query = "select preference from preferences where account_id = ? and notification_for = ?";
                $res = run_select_query($query, [$id, $notification_for]);
                $subject = new DonoData(); 
                break;
        }

        while($row = $res->fetch_assoc()){
            $preferences[] = $row['preference'];
            switch($row['preference']){
                case 1:
                    $listener = new EmailListener($subject);
                    break;

            }
        }

        return $subject;
    }


    public static function getUserById(int $accountId): ?array {
        $query = "SELECT a.account_id, a.username, a.email, at.account_type_name  AS account_type
              FROM Account a
              JOIN Account_Types at ON a.account_type_id = at.account_type_id
              WHERE a.account_id = ?";
        $result = run_select_query($query, [$accountId]);

        if ($result !== null && $result->num_rows > 0) {
            return $result->fetch_assoc();
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
            return $result->fetch_assoc(); 
        } else {
            return null; 
        }
    }

    public static function getUserIDByUsername(string $username){
        
        $query = "SELECT a.account_id, a.username, at.account_type_name AS account_type
                  FROM Account a
                  JOIN Account_Types at ON a.account_type_id = at.account_type_id
                  WHERE a.username = ?";
        
        $result = run_select_query($query, [$username]);
    
        
        if ($result !== null && !empty($result)) {
            return $result->fetch_assoc()["account_id"]; 
        } else {
            return null; 
        }
    }
    public static function getAccountId(string $username): ?int
    {
        $query = "SELECT account_id FROM Account WHERE username = ?";
        $result = run_select_query($query, [$username]);

        if ($result !== null && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['account_id'];
        } else {
            return null;
        }
    }


    

    

}











