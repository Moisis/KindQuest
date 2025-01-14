<?php


// require_once(dirname(__FILE__) ."/../../../core/Router.php");
require_once(__DIR__ . "/../../models/Auth/AuthStrategy.php");
require_once(__DIR__ . "/../../models/Auth/IndividualAuth.php");
require_once(__DIR__ . "/../../models/Auth/OrganizationAuth.php");
require_once(__DIR__ . "/../../models/Auth/AdminAuth.php");

require_once(__DIR__ . "/../../models/Auth/AuthLoginStrategyFactory.php");
require_once(__DIR__ . "/../Auth/RegisterController.php");


class LoginController
{
    private AuthStrategy $authStrategy;
    private AuthLoginStrategyFactory $authLoginStrategyFactory;

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
    public function login(array $credentials)
    {
        // Set the appropriate auth strategy based on user type

        $this->authLoginStrategyFactory = new AuthLoginStrategyFactory();
        $this->authStrategy = $this->authLoginStrategyFactory->createLoginStartegy($credentials['user_type']);

        $res = $this->authStrategy->login($credentials);
        if ($res === false) {
            header('Location: /login');
            exit();
        } else if($res === true){
            // echo 'success';
            $_SESSION["username"] = $credentials["username"];
            $_SESSION["ID"] = BaseAccount::getUserIDByUsername($credentials["username"]);
            $_SESSION['logged'] = true;

            if ($credentials['user_type'] === 'admin') {
                header('Location: /admin');
                exit();
            }

            header("Location: /");
            exit();
        }

    }


}
