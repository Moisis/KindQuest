<!--// Purpose: Contains the navigation bar for the website.-->

<header class="section page-header">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- RD Navbar Toggle-->
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <a href="/"><img class="brand-logo-light" src="/images/logo/logo-inverse-415x103.png" alt="Logo Brand" width="207" height="51"/></a>
                        </div>
                    </div>
                    <div class="rd-navbar-main-element">
                        <div class="rd-navbar-nav-wrap">
                            <!-- RD Navbar Nav-->
                            <ul class="rd-navbar-nav">
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/">Home</a></li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/events">Events</a></li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/about">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="button-group" style="display: flex; gap: 10px;">
                        <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] === true): ?>
                            <!-- Donate Button -->
                            <a class="button button-primary button-sm" href="/donatepage">Donate</a>

                            <!-- Profile Button with Dropdown -->
                            <div class="dropdown" style="position: relative;">
                                <button class="button button-secondary button-sm dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Profile
                                </button>
                                <div class="dropdown-menu" aria-labelledby="profileDropdown" style="position: absolute; top: 100%; left: 0; z-index: 10;">
                                    <a class="dropdown-item" href="/profile">View Profile</a>
                                    <a class="dropdown-item" href="/logout">Logout</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Sign Up Button for Guests -->
                            <a class="button button-secondary button-sm" href="/register">Sign Up</a>
                        <?php endif; ?>
                    </div>
            </div>
            </div>
        </nav>
    </div>
</header>


