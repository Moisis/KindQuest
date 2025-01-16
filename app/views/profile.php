<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>KindQuest | Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CRoboto:400%7CRubik:100,400,700">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
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
    <?php require dirname(__DIR__) . "/views/commonParts/navbar.php"; ?>


    <section class="parallax-container" data-parallax-img="images/about/bg-breadcrumbs-about.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h2 class="breadcrumbs-custom-title">Profile</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="/">Home</a></li>
                            <li class="active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Profile Section -->
    <section class="profile-section pt-5 pb-5">
        <div class="container">
            <div class="row">
                <!-- Profile Picture and Information -->
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/about/team/team-classic-4-390x252.jpg" class="card-img-top" alt="User Profile Picture">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $user_data['username'] ?> </h5>
                            <p class="card-text"><strong>Email :</strong> <?php echo $user_data['email'] ?> </p>
                            <p><strong>Role :</strong><?php echo $user_data['account_type'] ?? 'Unknown' ?></p>                        </div>
                    </div>
                </div>

                <!-- Badges Section -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>User Achievements</h4>
                        </div>
                        <div class="card-body">
                            <h5>Badges</h5>


                            <!-- Example Badges -->
                            <?php
                            // Loop through each event and display it dynamically
                            $userBadges  = explode("#", $badges->getName()) ?? [];
                            foreach ($userBadges as $badge) {
                            ?>
                            <span class="badge bg-primary"><?php echo $badge ?></span>


                            <?php
                            }
                            ?>

                            <hr>
                            <p>Here are your Points :</p>
                            <h5>Points </h5>
                            <ul>
                                <li><?php  echo $userpoints  = $badges->getPoints() ?? []; ?> </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Profile Form -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Profile</h4>
                        </div>
                        <div class="card-body">
                            <form id="updateProfileForm" action="/update_profile" method="POST" enctype="multipart/form-data">
                                <!-- Name -->
                                <div class="mb-3">
<!--                                    <label for="userName" class="form-label">Name</label>-->
                                    <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $user_data['username'] ?>" required placeholder="Enter Username ">
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
<!--                                    <label for="userEmail" class="form-label">Email</label>-->
                                    <input type="email" class="form-control" id="userEmail" name="userEmail" value="<?php echo $user_data['email'] ?>" placeholder="Enter Email " required>
                                </div>

                                <!-- Password  -->
                                <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password " required>
                                </div>
                                <!-- Confirm_password -->
                                <div class="mb-3">
<!--                                    <label for="userStatus" class="form-label">Status</label>-->
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password " required>
                                </div>

                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <?php require_once dirname(__DIR__) . "/views/commonParts/footer.php"; ?>

</div>
<div class="snackbars" id="form-output-global"></div>

<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
</body>

</html>
