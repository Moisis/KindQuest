<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>KindQuest | Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CRoboto:400%7CRubik:100,400,700">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        form{
            display: inline;
        }
        button{
            display: inline;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #333;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>
<div class="preloader">
    <div class="preloader-body">
        <div class="cssload-container">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
    </div>
</div>
<div class="page">
    <!-- Page Header-->
<!--    --><?php //require dirname(__DIR__) . "/views/commonParts/navbar.php"; ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/admin">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/users">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/events">Events</a>
            </li>
            <li class="nav-item">
                <!-- Profile Button with Dropdown -->
                <div class="dropdown" style="position: relative;">
                    <button class="button button-primary button-sm dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </button>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown" >
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Admin Dashboard</h2>
            <!-- <p>Welcome to the admin dashboard. Here you can manage users, settings, and view reports.</p> -->
             
            <h6>Individuals</h6>
            <?php
                foreach($users as $user){
                    echo $user['account_id'];
                    echo "   ";
                    echo $user['username'];
                    echo "   ";
                    echo $user['email'];

                    if($user['suspended'] == 0){
                        echo "Msh metzaneb";
                        ?>

                        <form action="/admin/users/suspend" method="post">
                            <input type="hidden" name="user_id" value=<?php echo $user['account_id']?>>
                            <br>
                            <button type="submit">Suspend</button>
                        </form>
                    <?php
                    }else{
                        // echo "Metzaneb";
                        ?>

                        <form action="/admin/users/unsuspend" method="post">
                            <input type="hidden" name="user_id" value=<?php echo $user['account_id']?>>
                            <br>
                            <button type="submit">Unsuspend</button>
                             
                        </form>
                    <?php

                    }

                    echo "<br><br><br>";
                }
            ?>

            <h6>Organizations</h6>
            <?php
                foreach($organizations as $user){
                    echo $user['account_id'];
                    echo "   ";
                    echo $user['username'];
                    echo "   ";
                    echo $user['email'];

                    if($user['suspended'] == 0){
                        // echo "Msh metzaneb";
                        ?>

                        <form action="/admin/users/suspend" method="post">
                            <input type="hidden" name="user_id" value=<?php echo $user['account_id']?>>
                            <br>
                            <button type="submit">Suspend</button>
                        </form>
                    <?php
                    }else{
                        // echo "Metzaneb";
                        ?>

                        <form action="/admin/users/unsuspend" method="post">
                            <input type="hidden" name="user_id" value=<?php echo $user['account_id']?>>
                            <br>
                            <button type="submit">Unsuspend</button>
                             
                        </form>
                    <?php

                    }

                    echo "<br><br><br>";
                }
            ?>
        </div>
    </div>

    <!-- Footer -->
</div>
<div class="snackbars" id="form-output-global"></div>

<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
</body>

</html>