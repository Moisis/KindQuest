<?php


require_once dirname(__DIR__, 2) . '/models/Badges/Badge.php';
require_once dirname(__DIR__, 2) . '/enums/BadgesTypes.php';


require_once(__DIR__ . "/../../models/AuthStrategyFactory.php");


class RegisterController {
    private AuthStrategyFactory $authStrategyFactory;

    // Method to load the default registration view
    public function index() {
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            require_once dirname(__DIR__, 2) . '/views/Auth/register.php';
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // username, email, password, user_type

            $userCredentials = [
                'username'=> $_POST['username'],
                'password'=> $_POST['password'],
                'email'=> $_POST['email'],
                'user_type'=> $_POST['user_type'],
            ];

            $this->register($userCredentials);

        }
    }

    // Method to handle registration based on user type
    private function register(array $data) {
        $this->authStrategyFactory = new AuthStrategyFactory();
        $authStrategy = $this->authStrategyFactory->createStrategy($data['user_type']);
        $res = $authStrategy->register($data);
        if ($res === false) {
            header('Location: /register');
        } else if($res === true){
            // echo "Register success";
            $_SESSION["username"] = $data["username"];
            $_SESSION["ID"] = BaseAccount::getUserIDByUsername($data["username"]);
            $_SESSION["email"] = $data["email"];
            $user_id = $this->getUserId();

            Badge::addBadgeToUser($user_id, BadgesTypes::NewComer->value);
            $_SESSION["badge"] = new BaseBadge();

            $_SESSION['logged'] = true;


            if ($data['user_type'] === 'admin') {
                header('Location: /admin');
                exit();
            }


            header('Location: /');
            exit();

        }



        // // Register using the selected strategy
        // if (isset($this->authStrategy) && $this->authStrategy->register($data)) {
        //     echo "Registration successful.";
        // } else {
        //     echo "Registration failed.";
        // }
    }

    public static function getUserId(): ?int
    {
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            return BaseAccount::getAccountId($username);
        }
        return null;
    }

}