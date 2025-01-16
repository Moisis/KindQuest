<aside class="sidebar">
    <!-- RD Sidebar-->
    <div class="rd-sidebar-wrap">
        <nav class="rd-sidebar rd-sidebar-classic" data-layout="rd-sidebar-fixed">
            <div class="rd-sidebar-main-outer">
                <div class="rd-sidebar-main">
                    <!-- RD Sidebar Panel-->
                    <div class="rd-sidebar-panel">
                        <!-- RD Sidebar Toggle-->
                        <!-- RD Sidebar Brand-->
                        <div class="rd-sidebar-brand">
                            <a href="/"><img class="brand-logo-light" src="/images/logo/logo-inverse-415x103.png" alt="Logo Brand" width="207" height="51"/></a>
                        </div>
                    </div>
                    <div class="rd-sidebar-main-element">
                        <div class="rd-sidebar-nav-wrap">
                            <!-- RD Sidebar Nav-->
                            <ul class="rd-sidebar-nav">
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/admin">Dashboard</a></li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/admin/users">Users</a></li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="/admin/events">Events </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="button-group" style="display: flex; flex-direction: column; gap: 10px;">
                        <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] === true): ?>
                            <!-- Profile Button with Dropdown -->
                            <div class="dropdown" style="position: relative;">
                                <button class="button button-secondary button-sm dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Profile
                                </button>
                                <div class="dropdown-menu" aria-labelledby="profileDropdown" style="position: absolute; top: 100%; left: 0; z-index: 10;">
                                    <!--                                    <a class="dropdown-item" href="/profile">View Profile</a>-->
                                    <a class="dropdown-item" href="/logout">Logout</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</aside>