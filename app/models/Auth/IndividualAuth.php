<?php


require_once "AuthStrategy.php";
require_once dirname(__DIR__,2) . "/models/Users/BaseAccoount.php";
require_once dirname(__DIR__,2) ."/enums/NotificationFor.php";
require_once dirname(__DIR__,2) ."/enums/Preference.php";


class IndividualAuth implements AuthStrategy
{

    public function register(array $data): bool
    {
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $email = $data['email'];


        $checkQuery = "SELECT * FROM Account WHERE username = '$username' AND account_type_id = 2";
        $checkResult = run_select_query($checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            return false;
        }

        $insertQuery = "INSERT INTO Account (username, email ,password, account_type_id, suspended) VALUES ('$username','$email', '$password', 2, 0)";
        $insertResult = run_insert_query($insertQuery);

        $query = "INSERT INTO Preferences (account_id, notification_for, preference) VALUES (?, ?, ?)";
        $account_id = BaseAccount::getAccountId($username);
        run_insert_query($query, [$account_id, NotificationFor::Donation->value,Preference::Email->value]);

        $query = "INSERT INTO Preferences (account_id, notification_for, preference) VALUES (?, ?, ?)";
        $account_id = BaseAccount::getAccountId($username);
        run_insert_query($query, [$account_id, NotificationFor::Donation->value,Preference::Logging->value]);

        return $insertResult; 
    }

    public function login(array $credentials): bool
    {
        // Access database connection directly

        $username = $credentials['username'];
        $password = $credentials['password'];

        // Directly use variables in the SQL statement
        $query = "SELECT * FROM Account WHERE username = '$username' AND account_type_id = 2";
        $result = run_select_query($query);

        if ($result && mysqli_num_rows($result) > 0) {

            $user = mysqli_fetch_assoc($result);
            $storedPasswordHash = $user['password'];


            if (password_verify($password, $storedPasswordHash)) {
                return true;

            } else {
                return false;
            }
        }

        return false;

    }

    public function logout(): void
    {
        // TODO: Implement logout() method.
    }

    public function update(array $data): bool
    {   
        $id = $data['account_id'];
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $email = $data['email'];



        $checkQuery = "SELECT * FROM Account WHERE account_id = '$id' AND account_type_id = 2";
        $checkResult = run_select_query($checkQuery);


        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            

            $insertQuery = "UPDATE Account SET username = '$username', email = '$email', password = '$password' WHERE account_id = $id";

            $insertResult = run_update_query($insertQuery);
    
            return $insertResult;

            
        }
        
        return false;
       
    }
}