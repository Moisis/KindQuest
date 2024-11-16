<?php
require_once dirname(__DIR__) . "/enums/DonationMethodTypes.php";
?>

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
            <h3 class="text-center">Choose a Fundraising Event to Donate To</h3>
            <div class="row row-50">
                <?php
                // Loop through each event and display it dynamically
                $fundraising_events = $fundraising_events ?? [];
                foreach ($fundraising_events as $event) {
                ?>
                <!-- Event 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="box-icon-modern">
                        <div class="box-icon-inner decorate-triangle"><span class="icon-xl linearicons-umbrella2 icon-primary"></span></div>
                        <div class="box-icon-caption">
                            <h4>Event #<?php echo htmlspecialchars($event ->getEventId()) ;  echo " ". htmlspecialchars($event -> getEventName())?> </h4>
                            <p> <?php echo htmlspecialchars($event ->getDescription()) ?>.</p>
                            <form action="/donate" method="post">
                                <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event ->getEventId()) ;?>" id="event_id">
                                <input type="hidden" name="account_id" value="1" id="account_id">

                                <label for="amount">Amount:</label>
                                <input type="number" id="amount" name="amount" min="5" placeholder="USD" required>

                                <label for="payment1">Payment Method:</label>
                                <select id="payment1" name="donation_method" required>
                                    <option value="<?php echo DonationMethodTypes::Visa ->value  ?>">Visa</option>
                                    <option value="<?php echo DonationMethodTypes::Fawry -> value ?> ">Fawry</option>
                                    <option value="<?php echo DonationMethodTypes::Cash -> value ?>">Cash</option>
                                </select>

                                <button type="submit" class="btn btn-primary mt-2">Donate</button>
                            </form>
                        </div>
                    </div>
                </div>

                    <?php
                }
                ?>

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
