<?php

// require_once(dirname(__FILE__) ."/../../../core/Router.php");
require_once(__DIR__ . "/../../models/Auth/AuthStrategy.php");
require_once(__DIR__ . "/../../models/Auth/IndividualAuth.php");
require_once(__DIR__ . "/../../models/Auth/OrganizationAuth.php");
require_once(__DIR__ . "/../../models/Auth/AdminAuth.php");

require_once(__DIR__ . "/../Auth/RegisterController.php");


class LoginController
{
    private AuthStrategy $authStrategy;

    // Method to load the default registration view
    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            require_once dirname(__DIR__, 2) . '/views/Auth/login.php';
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // user-type, contact-email, contact-password
            $userCredentials = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'user_type' => $_POST['user_type'],
            ];

            $this->login($userCredentials);

        }
    }



    // Method to handle login based on user type
    private function login(array $credentials)
    {
        echo "logging in...";
        // Set the appropriate auth strategy based on user type
        if ($credentials['user_type'] === 'individual') {
            $this->authStrategy = new IndividualAuth();
        } elseif ($credentials['user_type'] === 'organization') {
            $this->authStrategy = new OrganizationAuth();
        }

        $res = $this->authStrategy->login($credentials);
        if ($res === false) {
            echo 'failed';
            header('Location: http://localhost:8000/login');
        } else if($res === true){
            // echo 'success';
            header("Location: http://localhost:8000/");
        }

        // // Login using the selected strategy
        // if (isset($this->authStrategy) && $this->authStrategy->login($credentials)) {
        //     echo "Login successful.";
        // } else {
        //     echo "Login failed.";
        // }
    }


}
