<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>KindQuest | Donation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CRoboto:400%7CRubik:100,400,700">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
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
    <?php require_once dirname(__DIR__) . "/views/commonParts/navbar.php"; ?>

    <!-- Parallax Container -->
    <section class="parallax-container" data-parallax-img="images/about/bg-breadcrumbs-about.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h2 class="breadcrumbs-custom-title">Donation Page</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="/">Home</a></li>
                            <li class="active">Donation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Events Section -->
    <section class="section section-lg bg-default">
        <div class="container">
            <h3 class="text-center">Choose an Event to Donate To</h3>
            <div class="row row-50">
                <!-- Event 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="box-icon-modern">
                        <div class="box-icon-inner decorate-triangle"><span class="icon-xl linearicons-umbrella2 icon-primary"></span></div>
                        <div class="box-icon-caption">
                            <h4>Event One - Support Local Schools</h4>
                            <p>Your donation will help provide educational supplies for underprivileged children.</p>
                            <form action="/donate" method="post">
                                <input type="hidden" name="event" value="support-local-schools">
                                <label for="amount1">Amount:</label>
                                <input type="number" id="amount1" name="amount" min="5" placeholder="USD" required>

                                <label for="payment1">Payment Method:</label>
                                <select id="payment1" name="payment_method" required>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>

                                <button type="submit" class="btn btn-primary mt-2">Donate</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Event 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="box-icon-modern">
                        <div class="box-icon-inner decorate-circle"><span class="icon-xl linearicons-heart icon-primary"></span></div>
                        <div class="box-icon-caption">
                            <h4>Event Two - Medical Aid for Children</h4>
                            <p>Help us provide essential medical treatment to children in need.</p>
                            <form action="/donate" method="post">
                                <input type="hidden" name="event" value="medical-aid-for-children">
                                <label for="amount2">Amount:</label>
                                <input type="number" id="amount2" name="amount" min="5" placeholder="USD" required>

                                <label for="payment2">Payment Method:</label>
                                <select id="payment2" name="payment_method" required>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>

                                <button type="submit" class="btn btn-primary mt-2">Donate</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Event 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="box-icon-modern">
                        <div class="box-icon-inner decorate-rectangle"><span class="icon-xl linearicons-earth icon-primary"></span></div>
                        <div class="box-icon-caption">
                            <h4>Event Three - Community Food Drive</h4>
                            <p>Contribute to our efforts in distributing food to low-income families in need.</p>
                            <form action="/donate" method="post">
                                <input type="hidden" name="event" value="community-food-drive">
                                <label for="amount3">Amount:</label>
                                <input type="number" id="amount3" name="amount" min="5" placeholder="USD" required>

                                <label for="payment3">Payment Method:</label>
                                <select id="payment3" name="payment_method" required>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>

                                <button type="submit" class="btn btn-primary mt-2">Donate</button>
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
