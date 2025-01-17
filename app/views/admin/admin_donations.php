<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>KindQuest | Admin Users </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CRoboto:400%7CRubik:100,400,700">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>


<?php require dirname(__DIR__,2) . "/views/commonParts/adminSidebar.php"; ?>



<div class="page-content">

    <!-- Main Content -->
    <div class="main-content">
            <div class="container">
                    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Donations Page</h1>
        <p class="mb-4">This page shows all donations made.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Individuals</h6>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable"  cellspacing="0">
                        <thead>
                        <tr>
                            <th>Donations ID</th>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Account Type</th>
                            <th>Event ID</th>
                            <th>Event Name</th>
                            <th>Amount</th>
                            <th>Donation Method</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($donations as $donation){

                            $accountType = AccountTypes::from((int)$donation['account_type']);
                            $paymentMethod = DonationMethodTypes::from((int)$donation['donationMethod']);
                            echo "<tr>";
                            echo "<td>" . $donation['donationID'] . "</td>";
                            echo "<td>" . $donation['userID'] . "</td>";
                            echo "<td>" . $donation['username'] . "</td>";
                            echo "<td>". $accountType->name ."</td>";
                            echo "<td>". $donation['eventID'] ."</td>";
                            echo "<td>". $donation['eventName'] ."</td>";
                            echo "<td>". $donation['amount'] ."</td>";
                            echo "<td>". $paymentMethod->name ."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Organizations </h6>
            </div>
            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>E-Mail</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($organizations as $user){
                                            echo "<tr>";
                                            echo "<td>" . $user['account_id'] . "</td>";
                                            echo "<td>" . $user['username'] . "</td>";
                                            echo "<td>" . $user['email'] . "</td>";
                                            echo "<td>";
                                            if($user['suspended'] == 0){
                                                echo "<form action='/admin/users/suspend' method='post'>";
                                                echo "<input type='hidden' name='user_id' value='" . $user['account_id'] . "'>";
                                                echo "<button class='button mt-0 button-sm button-google' type='submit'>Suspend</button>";
                                                echo "</form>";
                                            } else {
                                                echo "<form action='/admin/users/unsuspend' method='post'>";
                                                echo "<input type='hidden' name='user_id' value='" . $user['account_id'] . "'>";
                                                echo "<button class='button mt-0 button-sm button-primary' type='submit'>Unsuspend</button>";
                                                echo "</form>";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                    </div>
            </div>
    </div>



    <!-- Footer -->
</div>
<div class="snackbars" id="form-output-global"></div>

<script src="../js/core.min.js"></script>
<script src="../js/script.js"></script>
</body>

</html>