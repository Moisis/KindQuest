<?php

declare(strict_types=1);

class Admin extends BaseAccount{


    public function __construct(int $accountId) {
        
        $query = "SELECT a.account_id, a.username, a.password, a.email, at.account_type_name 
                  FROM Account a 
                  JOIN Account_Types at ON a.account_type_id = at.account_type_id 
                  WHERE a.account_id = ?";
        $result = run_select_query($query, [$accountId]);

        // If account exists, set the attributes, else do not create the object
        if ($result !== null && !empty($result)) {
            $this->userID = $result[0]['account_id'];  
            $this->userName = $result[0]['username'];  
            $this->password = $result[0]['password'];  
            $this->email = $result[0]['email'];        
            $this->accountType = $result[0]['account_type_name'];  

            
            $this->auth = new AdminAuth();
            $this->suspended = false;
        } else {
            
            return null;
        }
    }



    public function register(array $credentials): bool {

        return$this->auth->register($credentials);
    }
   


    public function login(array $credentials): bool {

        return$this->auth->login($credentials);
    }


    public function setAuthStrategy (AuthStrategy $auth) : void {

        $this->auth = $auth;

}


public function listAllUsers(): array
{
    $query = "
        SELECT a.account_id, a.username, a.email 
        FROM Account a
        JOIN Account_Types at ON a.account_type_id = at.account_type_id
        WHERE a.account_type_id = :account_type_id
    ";
    $result = run_select_query($query, ['account_type_id' => 2]); // 2 for user account type
    $users = [];
    
    foreach ($result as $row) {
        $users[] = [
            'account_id' => $row['account_id'],
            'username' => $row['username'],
            'email' => $row['email']
        ];
    }
    
    return $users;
}

public function listAllOrganizers(): array
{
    $query = "
        SELECT a.account_id, a.username, a.email 
        FROM Account a
        JOIN Account_Types at ON a.account_type_id = at.account_type_id
        WHERE a.account_type_id = :account_type_id
    ";
    $result = run_select_query($query, ['account_type_id' => 3]); 
    $organizers = [];
    
    foreach ($result as $row) {
        $organizers[] = [
            'account_id' => $row['account_id'],
            'username' => $row['username'],
            'email' => $row['email']
        ];
    }
    
    return $organizers;
}




public function suspendUser(int $accountId): string
{
    // Check the account type and suspended status
    $query = "
        SELECT at.account_type_name, a.suspended 
        FROM Account a
        JOIN Account_Types at ON a.account_type_id = at.account_type_id
        WHERE a.account_id = :account_id
    ";
    $result = run_select_query($query, ['account_id' => $accountId]);

    if (empty($result)) {
        return "Account not found.";
    }

    $account = $result[0];

    if ($account['account_type_name'] === 'admin') {
        return "Can't be suspended.";
    }

    if ($account['suspended'] === 1) {
        return "Account already suspended.";
    }

    
    $updateQuery = "UPDATE Account SET suspended = 1 WHERE account_id = :account_id";
    run_update_query($updateQuery, ['account_id' => $accountId]); 

    return "Account suspended successfully.";
}



public function unsuspendUser(int $accountId): string
{
    $query = "
        SELECT at.account_type_name, a.suspended 
        FROM Account a
        JOIN Account_Types at ON a.account_type_id = at.account_type_id
        WHERE a.account_id = :account_id
    ";
    $result = run_select_query($query, ['account_id' => $accountId]);

    if (empty($result)) {
        return "Account not found.";
    }

    $account = $result[0];

    if ($account['account_type_name'] === 'admin') {
        return "Admin accounts cannot be unsuspended.";
    }

    if ($account['suspended'] === 0) {
        return "Account is not suspended.";
    }

    
    $updateQuery = "UPDATE Account SET suspended = 0 WHERE account_id = :account_id";
    run_update_query($updateQuery, ['account_id' => $accountId]);

    return "Account unsuspended successfully.";
}



public function listSuspendedAccounts(): array
{
    $query = "
        SELECT 
            a.account_id, 
            a.username, 
            a.email, 
            at.account_type_name
        FROM Account a
        JOIN Account_Types at ON a.account_type_id = at.account_type_id
        WHERE a.suspended = 1
    ";
    $result = run_select_query($query);
    $suspendedAccounts = [];
    
    foreach ($result as $row) {
        $suspendedAccounts[] = [
            'account_id' => $row['account_id'],
            'username' => $row['username'],
            'email' => $row['email'],
            'account_type_name' => $row['account_type_name']
        ];
    }
    
    return $suspendedAccounts;
}



  

}


