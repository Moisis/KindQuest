<?php

class RegisterController {
    private AuthStrategy $authStrategy;

    // Method to load the default registration view
    public function index() {
        require_once dirname(__DIR__, 2) . '/views/Auth/register.php';
    }

    // Method to handle registration based on user type
    public function register(array $data) {
        // Set the appropriate auth strategy based on user type
        if ($data['user_type'] === 'individual') {
            $this->authStrategy = new IndividualAuth();
        } elseif ($data['user_type'] === 'organization') {
            $this->authStrategy = new OrganizationAuth();
        }

        // Register using the selected strategy
        if (isset($this->authStrategy) && $this->authStrategy->register($data)) {
            echo "Registration successful.";
        } else {
            echo "Registration failed.";
        }
    }

    // Method to handle login based on user type
    public function login(array $credentials) {
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

    // Method to handle logout
    public function logout() {
        if (isset($this->authStrategy)) {
            $this->authStrategy->logout();
            echo "Logout successful.";
        } else {
            echo "No active session to log out.";
        }
    }
}
