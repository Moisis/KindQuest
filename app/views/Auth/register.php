<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>KindQuest | Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
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
    <?php include_once __DIR__ . '/../commonParts/navbar.php'; ?>

    <!-- Signup -->
    <section class="section section-lg bg-secondary-2 text-center">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-9 col-lg-7 mt-5">
                    <h3>Sign Up</h3>
                    <!-- RD Mailform-->
                    <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="/register">
                        <div class="form-wrap">
                            <input class="form-input" id="contact-username" type="text" name="username" data-constraints="@Required">
                            <label class="form-label" for="contact-username">Username</label>
                        </div>
                        <div class="form-wrap">
                            <input class="form-input" id="contact-email" type="email" name="email" data-constraints="@Email @Required">
                            <label class="form-label" for="contact-email">E-mail</label>
                        </div>
                        <div class="form-wrap">
                            <input class="form-input" id="contact-password" type="password" name="password" data-constraints="@Required">
                            <label class="form-label" for="contact-password">Password</label>
                        </div>
                        <div class="form-wrap">
                            <input class="form-input" id="contact-confirm-password" type="password" name="confirm_password" data-constraints="@Required">
                            <label class="form-label" for="contact-confirm-password">Confirm Password</label>
                        </div>
                        <!-- User Type Selection -->
                        <div class="form-wrap">
                            <label class="form-label" for="user-type">I am signing up as:</label>
                            <select class="form-input" id="user-type" name="user_type" data-constraints="@Required" required>
                                <option value="select-here" selected disabled>Select Here</option>
                                <option value="admin">Admin</option>
                                <option value="individual">Individual</option>
                                <option value="organization">Organization</option>

                            </select>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-7 col-lg-5">
                                <button class="button button-block button-lg button-primary" type="submit">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <!-- Link to Login Page -->
                    <p class="mt-3">Already have an account? <a href="/login">Log in here</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Footer-->
    <?php include_once __DIR__ . '/../commonParts/footer.php'; ?>
</div>
<div class="snackbar" id="form-output-global"></div>
<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>