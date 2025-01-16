<?php

require_once  dirname(__DIR__, 2).'/models/Users/Admin.php';

class AdminUsersController
{
    public function index() {
    

        $users = Admin::listAllUsers();
        $organizations = Admin::listAllOrganizers();

        require_once dirname(__DIR__ , 2) . "/views/admin/admin_users_page.php";
    }

    public function suspend(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['user_id'];
            Admin::suspendUser($id);
            header('Location: /admin/users');
        }
    }

    public function unsuspend(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['user_id'];
            Admin::unsuspendUser($id);
            header('Location: /admin/users');
        }
    }
}