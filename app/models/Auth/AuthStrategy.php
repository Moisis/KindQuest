<?php


interface AuthStrategy
{
    public function register(array $data): bool; // Handles registration

    public function login(array $credentials): bool; // Handles login

    public function logout(): void; // Handles logout
}
