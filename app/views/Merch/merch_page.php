<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>KindQuest | Merch </title>
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
    <?php require_once dirname(__DIR__, 2). "/views/commonParts/navbar.php"; ?>

    <!--        Parallax Container-->
    <section class="parallax-container" data-parallax-img="images/about/bg-breadcrumbs-about.jpg" >
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h2 class="breadcrumbs-custom-title">Merch</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="/">Home</a></li>
                            <li class="active">MERCH</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <div class="row justify-content-center text-center">
        <div class="col-md-9 col-lg-7 wow-outer">
            <div class="wow slideInDown">
                <h3>Exclusive Merch Collection</h3>
                <p>Explore our exclusive merch lineup! Every purchase supports meaningful events and makes a difference.</p>
            </div>
        </div>
    </div>



    <section class="product_section layout_padding">
        <div class="container">
            <div class="row">
                <?php
                while ($products->hasNext()) {
                    $product = $products->next();
                    ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <a class="button button-sm button-primary" href="/merch/<?php echo htmlspecialchars($product->getProductId()); ?>">
                                        View Details
                                    </a>
                                    <a href="" class="option2">
                                        Buy Now
                                    </a>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="<?php echo $product->getImagePath(); ?>" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    <?php echo $product->getProductName(); ?>
                                </h5>
                                <h6>
                                    $<?php echo $product->getPrice(); ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    
    <img src="../images/decor-wave-bottom.png"  alt="separator"/>


    <!--        footer-->
    <?php require_once dirname(__DIR__, 2) . "/views/commonParts/footer.php"; ?>

</div>
<div class="snackbars" id="form-output-global"></div>
<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>