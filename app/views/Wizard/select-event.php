<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KindQuest | Choose Event</title>
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
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

    <!-- Choose Event Section -->
    <section class="section section-lg bg-secondary-2 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-7 mt-5">
                    <h3>Step 2: Choose Event</h3>
                    <!-- Event Selection Form-->
                    <form class="rd-form rd-mailform" method="post" action="/wizard/handleRequest/next">
                        <div class="form-wrap">
                            <label class="form-label" for="event">Select an Event</label>
                            <select class="form-input" id="event" name="event">
                                <option value="" disabled <?php echo !isset($data['event']) ? 'selected' : ''; ?>>Choose an event</option>
                                <?php if (isset($fundraising_events) && $fundraising_events->hasNext()) : ?>
                                    <?php while ($fundraising_events->hasNext()) : ?>
                                        <?php $event = $fundraising_events->next(); ?>
                                        <option value="<?php echo htmlspecialchars($event->getEventId()); ?>" <?php echo (isset($data['event']) && $data['event'] == $event->getEventId()) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($event->getEventName()); ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <option value="" disabled>No events available</option>
                                <?php endif; ?>
                            </select>

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 col-sm-3">
                                <button class="button button-block button-lg button-secondary" type="submit"  formaction="/wizard/handleRequest/previous">Previous</button>
                            </div>
                            <div class="col-6 col-sm-3">
                                <button class="button button-block button-lg button-primary" type="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Footer -->
    <?php include_once __DIR__ . '/../commonParts/footer.php'; ?>
</div>
<div class="snackbar" id="form-output-global"></div>
<script src="/js/core.min.js"></script>
<script src="/js/script2.js"></script>
</body>
</html>





<!--<!-- step2.php -->
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>Wizard - Step 2</title>-->
<!--    <style>-->
<!--        body { font-family: Arial, sans-serif; margin: 20px; }-->
<!--        label { display: inline-block; width: 100px; margin: 10px 0; }-->
<!--        input { padding: 5px; margin: 5px 0; }-->
<!--        button { padding: 8px 15px; margin: 10px 0; }-->
<!--        .error { color: red; margin: 10px 0; }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<h1>Step 2: Contact Information</h1>-->
<?php //if(isset($errors)): ?>
<!--    <div class="error">-->
<!--        --><?php //echo $errors; ?>
<!--    </div>-->
<?php //endif; ?>
<!---->
<!--<form method="post" action="/wizard/handleRequest/next">-->
<!--    <label for="email">Email:</label>-->
<!--    <input type="email" id="email" name="email"-->
<!--           value="--><?php //echo isset($data['email']) ? $data['email'] : ''; ?><!--"-->
<!--           placeholder="Enter your email" />-->
<!--    <br />-->
<!---->
<!--    <label for="phone">Phone:</label>-->
<!--    <input type="tel" id="phone" name="phone"-->
<!--           value="--><?php //echo isset($data['phone']) ? $data['phone'] : ''; ?><!--"-->
<!--           placeholder="Enter your phone number" />-->
<!--    <br />-->
<!---->
<!--    <button type="submit"  formaction="/wizard/handleRequest/previous">Previous</button>-->
<!--    <button type="submit"  >Next</button>-->
<!--</form>-->
<!--</body>-->
<!--</html>-->