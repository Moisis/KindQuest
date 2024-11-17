<?php

require_once(__DIR__ . "/../models/Users/BaseAccoount.php");


class ProfileController {
    private AuthStrategy $authStrategy;

    public function index(): void
    {
        session_regenerate_id();

        $user_id = $this->getUserId();
        $user_data = $this->getUserDetails($user_id);

        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            header("Location: /");
            exit();
        }

        $badges = $this->getallbadges($user_id);

        require_once dirname(__DIR__) . "/views/profile.php";
    }

    public function getallbadges($user_id) {
        return Badge::getBadgesByUserID($user_id);
    }


    //TODO Remove Duplicate Code
    public static function getUserDetails($user_id): ?array
    {
        return BaseAccount::getUserById($user_id);
    }

    public static function getUserId(): ?int
    {
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            return BaseAccount::getAccountId($username);
        }
        return null;
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $user_id = $this->getUserId();
        $user_data = $this->getUserDetails($user_id);

        $username = $_POST['userName'];
        $email = $_POST['userEmail'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            return;
        }

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'account_id' => $user_id,
            'account_type' => $user_data['account_type']
        ];

        $this->updateUser($data);
        }else{
            header('Location: /profile');
        }

    }

    public function updateUser(array $data): void
    {



        if ($data['account_type'] === 'Individual') {
            $this->authStrategy = new IndividualAuth();
        } elseif ($data['account_type'] === 'Organization') {
            $this->authStrategy = new OrganizationAuth();
        }


        $res = $this->authStrategy->update($data);
        if ($res === false) {
            header('Location: /profile');
        } else if($res === true){
            $_SESSION["username"] = $data["username"];
            $_SESSION['logged'] = true;
            header('Location: /');
            exit();
        }
    }

    public function logout()
    {
        $_SESSION['logged'] = false;
        session_unset();
        session_destroy();
        header("Location: /");
        exit();
    }
}

?>