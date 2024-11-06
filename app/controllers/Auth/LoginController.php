<?php


class LoginController
{
    private AuthStrategy $authStrategy;

    // Method to load the default registration view
    public function index()
    {
        require_once dirname(__DIR__, 2) . '/views/Auth/login.php';
    }



    // Method to handle login based on user type
    public function login(array $credentials)
    {
        // Set the appropriate auth strategy based on user type
        if ($credentials['user_type'] === 'individual') {
            $this->authStrategy = new IndividualAuth();
        } elseif ($credentials['user_type'] === 'organization') {
            $this->authStrategy = new OrganizationAuth();
        }

        // Login using the selected strategy
        if (isset($this->authStrategy) && $this->authStrategy->login($credentials)) {
            echo "Login successful.";
        } else {
            echo "Login failed.";
        }
    }


}
