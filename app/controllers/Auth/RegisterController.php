<?php


require_once dirname(__DIR__, 2) . '/models/Badges/Badge.php';
require_once dirname(__DIR__, 2) . '/enums/BadgesTypes.php';



class RegisterController {
    private AuthStrategy $authStrategy;

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
        // Set the appropriate auth strategy based on user type
        if ($data['user_type'] === 'individual') {
            $this->authStrategy = new IndividualAuth();

        } elseif ($data['user_type'] === 'organization') {
            $this->authStrategy = new OrganizationAuth();
        }

        $res = $this->authStrategy->register($data);
        if ($res === false) {
            //  echo "Register Failed";
            header('Location: /register');


        } else if($res === true){
            // echo "Register success";

            Badge::addBadgeToUser(1, BadgesTypes::NewComer->value);
            $_SESSION["username"] = $data["username"];
            $_SESSION['logged'] = true;
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
}