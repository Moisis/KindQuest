<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KindQuest | Login</title>
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900|Roboto:400|Rubik:400,700">
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

    <!-- Login Section -->
    <section class="section section-lg bg-secondary-2 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-7 mt-5">
                    <h3>Login</h3>
                    <!-- RD Mailform-->
                    <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="/login">
                        <div class="form-wrap">
                            <label class="form-label" for="contact-email">Username</label>
                            <input class="form-input" id="contact-email" type="text" name="username" data-constraints="@Required">
                        </div>
                        <div class="form-wrap">
                            <label class="form-label" for="contact-password">Password</label>
                            <input class="form-input" id="contact-password" type="password" name="password" data-constraints="@Required">
                        </div>
                        <div class="form-wrap">
                            <label class="form-label" for="user-type">I am signing up as:</label>
                            <select class="form-input" id="user-type" name="user_type" data-constraints="@Required" required>
                                <option value="select-here" disabled selected>Select Here</option>
                                <option value="admin">Admin</option>
                                <option value="individual">Individual</option>
                                <option value="organization">Organization</option>
                            </select>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-7 col-lg-5">
                                <button class="button button-block button-lg button-primary" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                    <p class="mt-3">Don't Have Account? <a href="/register">Sign Up here</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Footer -->
    <?php include_once __DIR__ . '/../commonParts/footer.php'; ?>
</div>
<div class="snackbar" id="form-output-global"></div>
<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>