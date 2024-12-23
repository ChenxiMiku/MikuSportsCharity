<nav class="navbar navbar-expand-lg shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="../images/logo.png" class="logo img-fluid" alt="Miku Sports Charity Platform">
            <span>
                <?php echo htmlspecialchars($title); ?>
                <small><?php echo htmlspecialchars($description); ?></small>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="navbarToggler">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php
                $navItems = [
                    '../public/' => 'Home',
                    '../public/about' => 'About',
                    '../public/events' => 'Charities',
                    '../public/volunteer' => 'Volunteer',
                ];

                $currentPage = basename($_SERVER['PHP_SELF']);

                foreach ($navItems as $link => $label) {
                    $isActive = ($link === $currentPage) ? 'active' : '';
                    $href = ($link === $currentPage) ? '#top' : $link;

                    echo "<li class='nav-item'>
                            <a class='nav-link $isActive' href='$href'>$label</a>
                          </li>";
                }
                ?>
                <li id="userLogin" class="nav-item mx-3">
                    <a class="nav-link custom-btn custom-border-btn btn" id="loginBtn" href="../public/login">Login</a>
                </li>
                <li class="nav-item my-auto ms-2">
                    <button class="btn btn-outline-secondary darkModeToggle">
                        <i class="fas bi-moon-fill"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>