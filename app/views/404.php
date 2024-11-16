<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>KindQuest | Error Page  </title>
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
    <?php require dirname(__DIR__) . "/views/commonParts/navbar.php"; ?>


    <!--        404-->
    <section class="section section-lg bg-secondary-2 text-center">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-9 col-lg-7 mt-5">
                    <h3>404</h3>
                    <h5>Page not found</h5>
                    <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                    <a class="button button-block button-lg button-primary" href="/">Go to Home</a>
                </div>
            </div>
        </div>

    </section>

    <!--        footer-->
    <?php require_once dirname(__DIR__) . "/views/commonParts/footer.php"; ?>

</div>
<div class="snackbars" id="form-output-global"></div>
<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>