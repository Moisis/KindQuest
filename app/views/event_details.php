<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>KindQuest | Events</title>
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
    <?php require_once dirname(__DIR__) . "/views/commonParts/navbar.php"; ?>

    <!--        Parallax Container-->
    <section class="parallax-container" data-parallax-img="/public/images/events/bg-breadcrumbs-events.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h2 class="breadcrumbs-custom-title">Event Details </h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="/">Home</a></li>
                            <li class="active"> Event Details </li>

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
                <div class="col-lg-6 pr-xl-5"><img src="/images/about/about-us-1-518x430.jpg" alt="" width="518" height="430"/>
                </div>
                <div class="col-lg-6">
                    <?php
                    $current_event = $current_event ?? " ";
                    $current_donation = $current_event -> getCurrDonations();
                    $donation_goal = $current_event ->getGoal();
                    $progress_percentage = ($current_donation / $donation_goal) * 100;
                    ?>
                    <h3><?php echo htmlspecialchars($current_event->getEventName()); ?></h3>
                    <div class="text-with-divider">
                        <div class="divider"></div>
                        <h4 class="text-opacity-70">Join us for our next big event!</h4>
                    </div>

                    <p><?php echo htmlspecialchars($current_event->getDescription()); ?></p>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_percentage; ?>%;" aria-valuenow="<?php echo $progress_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo round($progress_percentage); ?>%
                        </div>
                    </div>
                    <p>Raised: $<?php echo $current_donation; ?> of $<?php echo $donation_goal; ?></p>

                    <form method="post" action="/event/join/<?php echo $current_event->getEventId(); ?>" class="rd-form">
                        <input type="hidden" name="role" value="1">
                        <input type="hidden" name="event_id" value="<?php echo $current_event->getEventId(); ?>">
                        <button type="submit" class="button button-primary button-sm">Join as Volunteer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!--        footer-->
    <?php require_once dirname(__DIR__) . "/views/commonParts/footer.php"; ?>

</div>





<div class="snackbars" id="form-output-global"></div>
<script src= "/js/core.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>