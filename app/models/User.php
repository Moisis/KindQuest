<?php

declare(strict_types=1);

ob_start();
require_once "../../core/Database.php";
ob_end_clean();

class User
{
    private function __construct($properties)
    {
        foreach ($properties as $prop => $value) {
            $this->{$prop} = $value;
        }
    }
    public function __tostring()
    {
        $str = '<pre>';
        foreach ($this as $key => $value) {
            $str .= "$key: $value<br/>";
        }
        return $str . '</pre>';
    }
    // Creates and returns a User object given an ID that exists in the database, otherwise null
    static public function get_by_id($id): User|null
    {
        global $configs;
        $rows = run_select_query("SELECT * FROM $configs->DB_NAME.$configs->DB_USERS_TABLE WHERE id = '$id'");
        return $rows->num_rows > 0 ? new User($rows->fetch_assoc()) : null;
    }
    // Creates and returns a User object given an email and an md5 hash for a password if the user exists, otherwise null
    static public function get_by_email_and_password_hash($email, $md5Hash): User|null
    {
        global $configs;
        $rows = run_select_query("SELECT * FROM $configs->DB_NAME.$configs->DB_USERS_TABLE WHERE email = '$email' AND passwordHash = '$md5Hash'");
        return $rows->num_rows > 0 ? new User($rows->fetch_assoc()) : null;
    }
}
