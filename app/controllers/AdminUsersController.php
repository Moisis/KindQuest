<?php

require_once  dirname(__DIR__, 1).'/models/Users/Admin.php';

class AdminUsersController
{
    public function index() {
    

        $users = Admin::listAllUsers();
        $organizations = Admin::listAllOrganizers();

        require_once dirname(__DIR__) . "/views/admin_users_page.php";
    }

    public function suspend(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['user_id'];
            Admin::suspendUser($id);
        }
    }

    public function unsuspend(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['user_id'];

            Admin::unsuspendUser($id);
        }
    }
}