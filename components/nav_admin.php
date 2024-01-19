<!-- nav displayed when user is logged in -->


    <nav class="navbar navbar-expand-lg bg-light navbar-light">
        <div class="container py-1">
            <a class="navbar-brand fw-bold" id="title" href="index.php?username=<?php echo $user ?>">
            National Museum of Scotland
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav text-center mt-4 mt-lg-0">
                    <a class="nav-link fw-bold" href="index.php?username=<?php echo $user ?>">Home</a>
                    <a class="nav-link fw-bold" href="about.php?username=<?php echo $user ?>">About</a>
                    <a class="nav-link fw-bold" href="events.php?username=<?php echo $user ?>">Events</a>
                    <a class="nav-link fw-bold" href="contact.php?username=<?php echo $user ?>">Contact</a>

                    <li class="nav-item dropdown dropdown-center">
                        <a class="nav-link dropdown-toggle text-primary fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, <?php echo $user?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="booking.php?username=<?php echo $user ?>"><i class="bi bi-plus-square"></i> Book an event</a></li>
                            <li><a class="dropdown-item" href="admin.php?username=<?php echo $user ?>"><i class="bi bi-gear"></i> Manage Bookings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="change_pwd.php?username=<?php echo $user ?>"><i class="bi bi-key"></i> Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php?username=<?php echo $user ?>"><i class="bi bi-box-arrow-right"></i> Log out</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>