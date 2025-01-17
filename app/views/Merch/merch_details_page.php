<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>KindQuest | Merch Details </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CRoboto:400%7CRubik:100,400,700">
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
    <?php require_once dirname(__DIR__,2) . "/views/commonParts/navbar.php"; ?>

    <!--        Parallax Container-->
    <section class="parallax-container" data-parallax-img="/public/images/events/bg-breadcrumbs-events.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h2 class="breadcrumbs-custom-title">Merch Details </h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="/">Home</a></li>
                            <li class="active"> Merch Details </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--    Body Content-->

    <section class="section section-lg bg-gray-1 bg-gray-1-decor">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-4 pr-xl-5">
                    <img src="<?php echo htmlspecialchars($merch->getImagePath()); ?>" alt="" width="100%" height="auto"/>
                </div>
                <div class="col-lg-6">
                    <h3><?php echo htmlspecialchars($merch->getProductName()); ?></h3>
                    <div class="text-with-divider">
                        <div class="divider"></div>
                        <h4 class="text-opacity-70">Product Details</h4>
                    </div>
                    <p><?php echo htmlspecialchars($merch->getDescription()); ?></p>
                    <h5>Price: $<?php echo htmlspecialchars($merch->getPrice()); ?></h5>
                    <a href="/merch/checkout/<?php echo htmlspecialchars($merch->getProductId()); ?>" class="button button-primary button-sm">Add to Cart</a>
                </div>
            </div>
        </div>
    </section>


    <!--        footer-->
    <?php require_once dirname(__DIR__,2) . "/views/commonParts/footer.php"; ?>

</div>





<div class="snackbars" id="form-output-global"></div>
<script src= "/js/core.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>