
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KindQuest | Confirmation</title>
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900|Roboto:400|Rubik:400,700">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/style.css">
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

    <!-- Confirmation Section -->
    <section class="section section-lg bg-secondary-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3>Thank You!</h3>
                    <p class="mt-4">Your contribution has been successfully processed. We sincerely appreciate your support!</p>
                    <div class="row justify-content-center">
                        <div class="col-3 col-sm-6">
                            <a class="button button-block button-lg button-secondary" href="/events">Explore More Events</a>
                        </div>
                        <div class="col-3 col-sm-6">
                            <a class="button button-block button-lg button-primary" href="/">Back TO Home </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Footer -->
    <?php include_once __DIR__ . '/../commonParts/footer.php'; ?>
</div>
<div class="snackbar" id="form-output-global"></div>
<script src="/js/core.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>


<!---->
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>Wizard - Complete</title>-->
<!--    <style>-->
<!--        body { font-family: Arial, sans-serif; margin: 20px; }-->
<!--        .summary { margin: 20px 0; }-->
<!--        .summary h2 { color: #333; }-->
<!--        .summary p { margin: 5px 0; }-->
<!--        .success { color: green; font-weight: bold; }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<h1>Registration Complete!</h1>-->
<!--<p class="success">Thank you for completing the registration process.</p>-->
<!---->
<!--<div class="summary">-->
<!--    <h2>Summary of Your Information:</h2>-->
<!--    <p><strong>Name:</strong> --><?php //echo $data['firstName'] . ' ' . $data['lastName']; ?><!--</p>-->
<!--    <p><strong>Email:</strong> --><?php //echo $data['email']; ?><!--</p>-->
<!--    <p><strong>Phone:</strong> --><?php //echo $data['phone']; ?><!--</p>-->
<!---->
<!--    <h3>Your Preferences:</h3>-->
<!--    <ul>-->
<!--        --><?php //foreach($data['preferences'] as $preference): ?>
<!--            <li>--><?php //echo ucfirst(str_replace('Updates', ' Updates', $preference)); ?><!--</li>-->
<!--        --><?php //endforeach; ?>
<!--    </ul>-->
<!--</div>-->
<!---->
<!--<a href="/wizard/restart">Start New Registration</a>-->
<!--</body>-->
<!--</html>--><?php
