<?php
require_once dirname(__DIR__,2 ) . "/enums/DonationMethodTypes.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KindQuest | Billing Info</title>
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




    <!-- Billing Info Section -->
    <section class="section section-lg bg-secondary-2">

        <div class="container">

            <div class="row">
                <!-- Left Column: Billing Info -->
                <div class="col-lg-6">
                    <h3>Step 1: Billing Info</h3>
                    <!-- Billing Info Form-->
                    <form class="rd-form rd-mailform" method="post" action="/wizard/handleRequest/next">
                        <div class="form-wrap">
                            <label class="form-label" for="first-name">First Name</label>
                            <input class="form-input" id="first-name" type="text" name="first_name" value="<?php echo isset($data['first_name']) ? $data['first_name'] : ''; ?>" required>
                        </div>
                        <div class="form-wrap">
                            <label class="form-label" for="last-name">Last Name</label>
                            <input class="form-input" id="last-name" type="text" name="last_name"  value="<?php echo isset($data['last_name']) ? $data['last_name'] : ''; ?>" required>
                        </div>
                        <div class="form-wrap">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-input" id="email" type="email" name="email"  value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" required>
                        </div>
                        <div class="form-wrap">
                            <label class="form-label" for="address">Address</label>
                            <input class="form-input" id="address" type="text" name="address" value="<?php echo isset($data['address']) ? $data['address'] : ''; ?>" required>
                        </div>
                        <div class="form-wrap">
                            <label class="form-label" for="city">City</label>
                            <input class="form-input" id="city" type="text" name="city"  value="<?php echo isset($data['city']) ? $data['city'] : ''; ?>" required>
                        </div>
                        <div class="form-wrap">
                            <label class="form-label" for="zip">ZIP Code</label>
                            <input class="form-input" id="zip" type="text" name="zip" value="<?php echo isset($data['zip']) ? $data['zip'] : ''; ?>" required>
                        </div>

                        <div class="form-wrap">
                        <select class="form-input"  id="payment1" name="donation_method" required>
                            <option value="" disabled <?php echo !isset($data['donation_method']) ? 'selected' : ''; ?>>Choose a Donation Method </option>
                            <option value="<?php echo DonationMethodTypes::Visa->value; ?>">Visa</option>
                            <option value="<?php echo DonationMethodTypes::Fawry->value; ?>">Fawry</option>
                            <option value="<?php echo DonationMethodTypes::Cash->value; ?>">Cash</option>
                        </select>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-7 col-lg-5">
                                <button class="button button-block button-lg button-primary" type="submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Product Details -->

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

                            <p><strong>Product Name:</strong> <?php echo htmlspecialchars($product->getProductName() ?: 'N/A'); ?></p>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($product->getDescription() ?: 'No description available.'); ?></p>
                            <p><strong>Amount:</strong> $<?php echo htmlspecialchars($product->getPrice()); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <p>Product details are not available at the moment.</p>
                        </div>
                    <?php endif; ?>
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
