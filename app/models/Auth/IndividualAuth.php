<?php


require_once "AuthStrategy.php";
require_once __DIR__."/../../../../core/Database.php";


class IndividualAuth implements AuthStrategy
{

    public function register(array $data): bool
    {
        // TODO: Implement register() method.
    }

    public function login(array $credentials): bool
    {
        $db = Database::getConnection(); // Access database connection directly

        $query = "SELECT * FROM Account WHERE username = :username AND password = :password AND account_type = 'user'";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $credentials['username']);
        $stmt->bindParam(':password', $credentials['password']);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function logout(): void
    {
        // TODO: Implement logout() method.
    }
}