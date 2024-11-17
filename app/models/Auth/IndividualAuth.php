<?php


require_once "AuthStrategy.php";


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

        $insertQuery = "INSERT INTO Account (username, email ,password, account_type_id) VALUES ('$username','$email', '$password', 2)";
        $insertResult = run_insert_query($insertQuery);

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
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $email = $data['email'];



        $checkQuery = "SELECT * FROM Account WHERE username = '$username' AND account_type_id = 2";
        $checkResult = run_select_query($checkQuery);


        if (!$checkResult && mysqli_num_rows($checkResult) > 0) {
            return false;
        }

        $insertQuery = "UPDATE Account SET username = '$username', email = '$email', password = '$password', account_type_id = 2 WHERE account_id = {$data['account_id']}";

        $insertResult = run_update_query($insertQuery);

        return $insertResult;
    }
}