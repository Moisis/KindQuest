<?php


class AuthContext
{
    private AuthStrategy $authStrategy;

    // Set the desired authentication strategy at runtime
    public function setAuthStrategy(AuthStrategy $authStrategy): void
    {
        $this->authStrategy = $authStrategy;
    }

    // Delegate register, login, and logout calls to the chosen strategy
    public function register(array $data): bool
    {
        return $this->authStrategy->register($data);
    }

    public function login(array $credentials): bool
    {
        return $this->authStrategy->login($credentials);
    }

    public function logout(): void
    {
        $this->authStrategy->logout();
    }
}
