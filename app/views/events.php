<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>KindQuest | Events</title>
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

    <!--        Parallax Container-->
    <section class="parallax-container" data-parallax-img="images/events/bg-breadcrumbs-events.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h2 class="breadcrumbs-custom-title">Events</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="/">Home</a></li>
                            <li class="active">Events</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!--    Body Content-->

<!---->
<!--    <section class="section section-lg bg-gray-1 bg-gray-1-decor">-->
<!--        <div class="container">-->
<!--            <div class="row row-50">-->
<!--                <div class="col-lg-6 pr-xl-5"><img src="images/about/about-us-1-518x430.jpg" alt="" width="518" height="430"/>-->
<!--                </div>-->
<!--                <div class="col-lg-6">-->
<!--                    <h3>Upcoming Event</h3>-->
<!--                    <div class="text-with-divider">-->
<!--                        <div class="divider"></div>-->
<!--                        <h4 class="text-opacity-70">Join us for our next big event!</h4>-->
<!--                    </div>-->
<!--                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>-->
<!--                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->

    <section class="section section-lg bg-default">
        <div class="container">

            <?php if (isset($user_data) && $user_data['account_type'] === 'Organization')  : ?>
            <div class="row mb-4">
                <div class="col-md-8">
                    <input type="text" class="form-control" id="search-bar" placeholder="Search events...">
                </div>
                <div class="col-md-4 text-right">
                    <a class="button button-secondary button-sm" href="/event/create">Create Event </a>
                </div>
            </div>
            <?php endif; ?>


            <div class="row justify-content-center text-center">
                <div class="col-md-9 col-lg-7 wow-outer">
                    <div class="wow slideInDown">
                        <h3>Fundraiser Events</h3>
                        <p>At Helper, there are various charity causes and projects, in which you can always take part. Feel free to learn about them below or browse our website for more information.</p>
                    </div>
                </div>
            </div>
            <div class="row row-50">
                <?php
                // Loop through each event and display it dynamically
                $fundraising_events = $fundraising_events ?? [];
                foreach ($fundraising_events as $event) {
                    ?>
                    <div class="col-md-6 col-lg-4 wow-outer">
                        <div class="wow fadeInUp">
                            <article class="box-causes">
                                <div class="box-causes-img">
                                    <img src="images/favicon.png" alt="" width="372" height="396"/>

                                    <a class="button button-sm button-primary" href="/event/<?php echo htmlspecialchars($event->getEventId()); ?>">View</a>


                                </div>
                                <h4 class="font-weight-medium"><a href="#"><?php echo htmlspecialchars($event->getEventName()); ?></a></h4>
                                <p class="box-causes-donate"><span class="box-causes-donate-complete"> GOAL </span> of  <span><?php echo htmlspecialchars($event->getGoal()); ?></span> USD
                                </p>
                            </article>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>


<!--    Past Events-->
<!--    <section class="section section-lg bg-gray-1">-->
<!--        <div class="container">-->
<!--            <h3 class="text-center">Past Events</h3>-->
<!--            <div class="row no-gutters">-->
<!--                <div class="col-md-6 col-lg-4">-->
<!--                    <div class="team-classic">-->
<!--                        <div class="team-classic-figure"><img src="images/causes-01-372x396.jpg" alt="" width="390" height="252"/>-->
<!--                            <ul class="team-classic-soc-list">-->
<!--                                <li><a class="icon icon-md fa-facebook" href="#"></a></li>-->
<!--                                <li><a class="icon icon-md fa-instagram" href="#"></a></li>-->
<!--                                <li><a class="icon icon-md fa-twitter" href="#"></a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <div class="team-classic-caption">-->
<!--                            <h4><a class="team-name" href="#">Past Event One</a></h4>-->
<!--                            <p>Details about past event one.</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-6 col-lg-4">-->
<!--                    <div class="team-classic">-->
<!--                        <div class="team-classic-figure"><img src="images/causes-01-372x396.jpg" alt="" width="390" height="252"/>-->
<!--                            <ul class="team-classic-soc-list">-->
<!--                                <li><a class="icon icon-md fa-facebook" href="#"></a></li>-->
<!--                                <li><a class="icon icon-md fa-instagram" href="#"></a></li>-->
<!--                                <li><a class="icon icon-md fa-twitter" href="#"></a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <div class="team-classic-caption">-->
<!--                            <h4><a class="team-name" href="#">Past Event Two</a></h4>-->
<!--                            <p>Details about past event two.</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-6 col-lg-4">-->
<!--                    <div class="team-classic">-->
<!--                        <div class="team-classic-figure"><img src="images/causes-01-372x396.jpg" alt="" width="390" height="252"/>-->
<!--                            <ul class="team-classic-soc-list">-->
<!--                                <li><a class="icon icon-md fa-facebook" href="#"></a></li>-->
<!--                                <li><a class="icon icon-md fa-instagram" href="#"></a></li>-->
<!--                                <li><a class="icon icon-md fa-twitter" href="#"></a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <div class="team-classic-caption">-->
<!--                            <h4><a class="team-name" href="#">Past Event Three</a></h4>-->
<!--                            <p>Details about past event three.</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->

    <!--        footer-->
    <?php require_once dirname(__DIR__) . "/views/commonParts/footer.php"; ?>

</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    <div class="form-group">
                        <label for="eventName">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="eventName" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDate">Event Date</label>
                        <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Event Description</label>
                        <textarea class="form-control" id="eventDescription" name="eventDescription" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="snackbars" id="form-output-global"></div>
<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>