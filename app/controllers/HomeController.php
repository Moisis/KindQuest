<?php
// require_once "app/models/ContextAuthenticator.php"; // Adjust the path as necessary

class HomeController {
    public function index() {
        $msg = '';
        if (isset($_POST['login'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                // $context = new ContextAuthenticator();
                // $user = $context->login($_POST['email'], $_POST['password']);
                // if ($user) {
                //     // $msg .= "<strong>User found:</strong><br/><pre>$user</pre>";
                //     // Redirect to the shop upon successful login then terminate current script
                //     header("Location: shop/$user->id");
                //     exit();
                // } else {
                //     $msg .= "<strong>User not found.</strong><br/><br/><!--deng-->";
                // }
                echo "Login successful!";
            } else {
                $msg .= '<strong>Error: Please enter email and password.</strong>';
            }
        }
        // XXX: Absolutely disgusting, but it works... should use classes for cleaner code
        require_once dirname(__DIR__) . "/views/home.php";        
    }


    public function test(){
        echo "Test for  Unique Route ";
    }
}




?>
