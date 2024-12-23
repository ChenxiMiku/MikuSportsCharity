<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL & ~E_NOTICE);

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="login">
    <meta name="author" content="Chengwei Yan 694659">
    <meta name="author" content="Wentao Su 694641">
    <meta name="author" content="Ruilin Hu 694498">
    <meta name="author" content="Wentai Ge 694640">

    <title>Miku Sports Charity Platform - Let the Fun of Sports Be Accessible to Everyone</title>

    <link href="css/style.css" rel="stylesheet">
    <script src="js/checklogin.js"></script>
    <script src="js/toggler.js"></script>
    <link rel="icon" href="favicon.png" type="image/png">
</head>

<body>
    <?php

    $config = include('config/config.php');
    $address = $config['address'];
    $address_link = $config['address_link'];
    $email = $config['email'];
    $phone = $config['phone'];
    ?>

    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i class="bi-geo-alt me-2"></i>
                        <a href="https://www.google.com/maps/place/<?php urlencode($address_link) ?>" class="site-footer-link">
                            <?php $address ?>
                        </a>
                    </p>
                    <p class="d-flex mb-0">
                        <i class="bi-envelope me-2"></i>
                        <a href="mailto:<?php $email ?>">
                            <?php $email ?>
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="https://github.com/ChenxiMiku/MikuSportsCharity" class="social-icon-link bi-github"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" class="logo img-fluid" alt="Miku Sports Charity Platform">
                <span>
                    Miku Sports Charity Platform
                    <small>Let the Fun of Sports Be Accessible to Everyone</small>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="navbarToggler">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="events.html">Charities</a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="volunteer.html">Volunteer</a>
                    </li>

                    <li id="userLogin" class="nav-item mx-3">
                        <a class="nav-link custom-btn custom-border-btn btn" id="loginBtn" href="login.php">Login</a>
                    </li>

                    <div id="userAvatar" class="dropdown avatar-image me-5 d-none">
                        <a class="dropdown-toggle" href="#"">
                            <img id=" avatarImg" src="images/test/testavatar.png" alt="User Avatar" width="64"
                            height="64" class="rounded-circle">
                        </a>

                        <div class="dropdown-menu" aria-labelledby="avatarDropdown">
                            <a class="dropdown-item align-items-center" href="dashboard.html">
                                <i class="bi-speedometer2 me-2"></i>Dashboard
                            </a>

                            <a class="dropdown-item align-items-center logoutBtn" href="index.php">
                                <i class="bi-box-arrow-right me-2"></i>Log out
                            </a>
                        </div>
                    </div>

                    <li class="nav-item my-auto ms-2">
                        <button class="btn btn-outline-secondary darkModeToggle">
                            <i class="fas bi-moon-fill"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <section class="login-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div>
                    <div class="col-lg-5 col-12 mx-auto">
                        <form id="loginForm" class="custom-form login-form" action="" method="post" role="form">
                            <h3 class="mb-4 d-flex justify-content-center">Welcome Back</h3>
                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger text-center"><?php $error_message ?></div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-lg-12 col-12 mb-2">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email address" required aria-label="email"
                                        autocomplete="Email">
                                </div>
                                <div class="col-lg-12 col-12 mb-2">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" required aria-label="Password"
                                        autocomplete="current-password">
                                </div>
                                <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                                    <button type="submit" id="SigninBtn" class="custom-btn btn">Login</button>
                                </div>
                                <p class="col-lg-12 col-12 d-flex justify-content-center without-account">No account yet?</p>
                                <a class="col-lg-12 col-12 mb-2 d-flex justify-content-center without-account register-link"
                                    href="register.php">Sign Up</a>
                                <div class="col-lg-12 col-12 mb-2 divider-wrapper">
                                    <span class="divider">OR</span>
                                </div>
                                <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                                    <button type="submit" id="googleSignIn" class="custom-btn btn">
                                        <i class="bi-google me-2"></i> Continue with Google
                                    </button>
                                </div>
                                <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                                    <button type="submit" id="githubSignIn" class="custom-btn btn">
                                        <i class="bi-github me-2"></i> Continue with Github
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 mb-4">
                    <img src="images/logo.png" class="logo img-fluid" alt="">
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <h5 class="site-footer-title mb-3">Quick Links</h5>
                    <ul class="footer-menu">
                        <li><a href="about.html">About us</a></li>
                        <li><a href="events.php">Charities</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="volunteer.php">Become a volunteer</a></li>
                        <li><a href="#section_3">Make a donation</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5>Contact Information</h5>
                    <p><i class="bi-telephone me-2"></i><a href="tel:+8615098646873">+86 150-9864-6873</a></p>
                    <p><i class="bi-envelope me-2"></i><a href="mailto:charity@mikufans.me">charity@mikufans.me</a></p>
                    <p><i class="bi-geo-alt me-2"></i><a href="#">999 Huchenghuan Road, Pudong New District, Shanghai</a></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/counter.js"></script>
    <script src="js/thirdlogin.js"></script>
    <script src="js/login.js"></script>
    <script src="js/cookies.js"></script>
    <script src="js/darkmode.js"></script>
</body>

</html>