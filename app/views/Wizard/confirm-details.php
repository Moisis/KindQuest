<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KindQuest | Confirmation</title>
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
`
<div class="page">
    <!-- Page Header-->
    <?php include_once __DIR__ . '/../commonParts/navbar.php'; ?>

    <!-- Confirmation Section -->
    <section class="section section-lg bg-secondary-2">
        <div class="container ">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Step 3: Review & Confirm</h3>
                    <p class="mt-4">Please review the information below before submitting your contribution.</p>

                    <div class="review-summary bg-light p-4 rounded mt-5">
                        <h5>Review Details</h5>
                        <p><strong>First Name:</strong> <?php echo isset($data['first_name']) ? htmlspecialchars($data['first_name']) : 'N/A'; ?></p>
                        <p><strong>Last Name:</strong> <?php echo isset($data['last_name']) ? htmlspecialchars($data['last_name']) : 'N/A'; ?></p>
                        <p><strong>Email:</strong> <?php echo isset($data['email']) ? htmlspecialchars($data['email']) : 'N/A'; ?></p>
                        <p><strong>Address:</strong> <?php echo isset($data['address']) ? htmlspecialchars($data['address']) : 'N/A'; ?></p>
                        <p><strong>City:</strong> <?php echo isset($data['city']) ? htmlspecialchars($data['city']) : 'N/A'; ?></p>
                        <p><strong>ZIP:</strong> <?php echo isset($data['zip']) ? htmlspecialchars($data['zip']) : 'N/A'; ?></p>
                        <p><strong>Donation Method:</strong> <?php echo isset($data['donation_method']) ? DonationMethodTypes::from($data['donation_method'])->name : 'N/A'; ?></p>                    </div>
                </div>

                <div class="col-lg-6">
                    <h3>Product Details</h3>
                    <?php if (isset($product)): ?>
                        <div class="product-summary bg-light p-4 rounded shadow-sm">
                            <?php if ($product->getImagePath()): ?>
                                <img
                                        src="<?php echo htmlspecialchars($product->getImagePath()); ?>"
                                        alt="<?php echo htmlspecialchars($product->getProductName()); ?> Image"
                                        width="100vh" height="100vh"
                                >
                            <?php endif; ?>

                            <p><strong>Event Name:</strong> <?php echo htmlspecialchars($product->getProductName() ?: 'N/A'); ?></p>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($product->getDescription() ?: 'No description available.'); ?></p>
                            <p><strong>Amount:</strong> $<?php echo htmlspecialchars($product->getPrice()); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <p>Product details are not available at the moment.</p>
                        </div>
                    <?php endif; ?>

                    <h3>Event  Details</h3>
                    <?php if (isset($product)): ?>
                        <div class="product-summary bg-light p-4 rounded shadow-sm">
                            <p><strong>Event Name:</strong> <?php echo htmlspecialchars($current_event->getEventName() ?: 'N/A'); ?></p>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($current_event->getDescription() ?: 'No description available.'); ?></p>
                            <p><strong>Goal :</strong> $<?php echo htmlspecialchars($current_event ->getGoal()); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <p>Product details are not available at the moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row justify-content-between mt-4">
                <div class="col-6 text-left">
                    <a class="button button-secondary" href="/wizard/handleRequest/previous">Previous</a>
                </div>
                <div class="col-6 text-right">
                    <form method="post" action="/wizard/handleRequest/finish">
                        <button class="button button-primary" type="submit">Confirm & Submit</button>
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
<script src="/js/script.js"></script>
</body>
</html>
