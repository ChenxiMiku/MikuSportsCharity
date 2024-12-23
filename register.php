<?php
session_start();
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
unset($_SESSION['error_message'], $_SESSION['success_message']);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="register">
    <meta name="author" content="Chengwei Yan 694659">
    <meta name="author" content="Wentao Su 694641">
    <meta name="author" content="Ruilin Hu 694498">
    <meta name="author" content="Wentai Ge 694640">

    <title>Miku Sports Charity Platform - Register</title>

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
                <div class="col-lg-6 col-12 mx-auto">
                    <form class="custom-form login-form" action="common/register_handler.php" method="post" role="form">
                        <h3 class="mb-4 d-flex justify-content-center">Create an Account</h3>

                        <!-- Error or Success Message -->
                        <?php if (!empty($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger text-center">
                                <?php htmlspecialchars($_SESSION['error_message']);
                                unset($_SESSION['error_message']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($_SESSION['success_message'])): ?>
                            <div class="alert alert-success text-center">
                                <?php htmlspecialchars($_SESSION['success_message']);
                                unset($_SESSION['success_message']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <!-- Username Field -->
                            <div class="col-lg-12 col-12 mb-2">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" aria-label="Username" required>
                            </div>

                            <!-- Email Field -->
                            <div class="col-lg-12 col-12 mb-2">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" aria-label="Email" required>
                            </div>

                            <!-- Password Field -->
                            <div class="col-lg-12 col-12 mb-2">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-label="Password" required autocomplete="new-password">

                                <div class="progress">
                                    <div id="password-strength" class="progress-bar-passwd" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small id="password-strength-text" class="text-muted">Password strength: None</small>
                            </div>
                            <!-- Confirm Password Field -->
                            <div class="col-lg-12 col-12 mb-2">
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                                    placeholder="Confirm Password" aria-label="Confirm Password" required autocomplete="new-password">
                            </div>

                            <!-- Register Button -->
                            <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                                <button type="submit" id="registerBtn" class="custom-btn btn" disabled>Sign Up</button>
                            </div>

                            <!-- Already have an account Link -->
                            <p class="col-lg-12 col-12 d-flex justify-content-center without-account">Already have an account?</p>
                            <a class="col-lg-12 col-12 mb-2 d-flex justify-content-center without-account login-link" href="login.php">Log In</a>

                            <!-- Divider -->
                            <div class="col-lg-12 col-12 mb-2 divider-wrapper">
                                <span class="divider">OR</span>
                            </div>

                            <!-- Google Sign Up Button -->
                            <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                                <button type="submit" id="googleSignUp" class="custom-btn btn">
                                    <i class="bi-google me-2"></i> Continue with Google
                                </button>
                            </div>

                            <!-- Github Sign Up Button -->
                            <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                                <button type="submit" id="githubSignUp" class="custom-btn btn">
                                    <i class="bi-github me-2"></i> Continue with Github
                                </button>
                            </div>
                        </div>
                    </form>
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
                        <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">About us</a></li>

                        <li class="footer-menu-item"><a href="events.html" class="footer-menu-link">Charities</a></li>

                        <li class="footer-menu-item"><a href="dashboard.html" class="footer-menu-link">Dashboard</a></li>

                        <li class="footer-menu-item"><a href="volunteer.html" class="footer-menu-link">Become a volunteer</a></li>

                        <li class="footer-menu-item"><a href="#section_3" class="footer-menu-link">Make a donation</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                    <p class="text-white d-flex mb-2">
                        <i class="bi-telephone me-2"></i>

                        <a href="tel: +86 150-9864-6873" class="site-footer-link">
                            +86 150-9864-6873
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:info@yourgmail.com" class="site-footer-link">
                            charity@mikufans.me
                        </a>
                    </p>

                    <p class="text-white d-flex mt-3">
                        <i class="bi-geo-alt me-2"></i>

                        <a href="https://www.google.com/maps/place/999+Hucheng+Huanlu,+Pudong+New+Area,+Shanghai,+China/@30.8868445,121.8956191,17z/data=!3m1!4b1!4m6!3m5!1s0x35ad768034588f11:0x89d232b593411ad6!8m2!3d30.88684!4d121.90049!16s%2Fg%2F11g4fj_p1x?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D"
                            class="site-footer-link">
                            999 Huchenghuan Road, Pudong New District, Shanghai, China
                        </a>
                    </p>

                </div>
            </div>
        </div>

        <div class="site-footer-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-7 col-12 align-items-center d-flex">
                        <p class="copyright-text mb-0 align-items-center">Copyright © 2024 <a href="#">Miku Sports</a>
                            Charity Org.
                        </p>
                    </div>

                    <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-end align-items-center mx-auto">
                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="https://github.com/ChenxiMiku/MikuSportsCharity" class="social-icon-link bi-github"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="cookie-banner" class="cookie-banner">
        <div class="cookie-content d-flex">
            <div class="cookie-text col-lg-8 me-2 mt-2">
                <h4>Cookies</h4>
                <p>We use cookies to provide a better user experience. Click "Accept all cookies" to agree to the use of
                    cookies. You must accept cookies to log in.</p>
            </div>
            <button id="accept-cookies" class="cookie-btn btn col-lg-2 fs-6 me-2">Accept all cookies</button>
            <button id="reject-cookies" class="cookie-btn btn col-lg-2 fs-6">Reject</button>
        </div>
    </div>
    <!-- JAVASCRIPT FILES -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="js/thirdlogin.js"></script>
    <script src="js/cookies.js"></script>
    <script src="js/checklogin.js"></script>
    <script src="js/darkmode.js"></script>
    <script src="js/passwd.js"></script>
</body>

</html>