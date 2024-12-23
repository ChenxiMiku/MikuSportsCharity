<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="index">
    <meta name="author" content="Chengwei Yan 694659">
    <meta name="author" content="Wentao Su 694641">
    <meta name="author" content="Ruilin Hu 694498">
    <meta name="author" content="Wentai Ge 694640">

    <title>Miku Sports Charity Platform - Let the Fun of Sports Be Accessible to Everyone</title>

    <link href="css/style.css" rel="stylesheet">
    <script src="js/cookies.js"></script>
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
                        <a class="nav-link click-scroll" href="#top">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="events.php">Charities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="volunteer.php">Volunteer</a>
                    </li>
                    <li id="userLogin" class="nav-item mx-3">
                        <a class="nav-link custom-btn custom-border-btn btn" id="loginBtn" href="login.php">Login</a>
                    </li>
                    <div id="userAvatar" class="dropdown avatar-image me-5 d-none">
                        <a class="dropdown-toggle" href="#">
                            <img id="avatarImg" src="images/test/testavatar.png" alt="User Avatar" width="64"
                                height="64" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="avatarDropdown">
                            <a class="dropdown-item align-items-center" href="dashboard.php">
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
        <section class="hero-section hero-section-full-height">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12 p-0">
                        <div id="hero-slide" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item carousel-item-prev carousel-item-next active">
                                    <img src="images/slide/1.jpg" class="carousel-image img-fluid" alt="...">
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Enjoy sports</h1>
                                        <p>Let everyone enjoy the fun of sports recording</p>
                                    </div>
                                </div>
                                <div class="carousel-item carousel-item-next carousel-item-prev">
                                    <img src="images/slide/2.png" class="carousel-image img-fluid" alt="...">
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Non-profit</h1>
                                        <p>You can support us to grow more</p>
                                    </div>
                                </div>
                                <div class="carousel-item carousel-item-next carousel-item-prev">
                                    <img src="images/slide/3.png" class="carousel-image img-fluid" alt="...">
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Join us</h1>
                                        <p>Make sport accessible to everyone with us</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" id="prevBtnHero">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" id="nextBtnHero">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12 text-center mx-auto">
                        <h2 class="mb-5">Welcome to Miku Sports Charity Platform</h2>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="volunteer.html" class="d-block">
                                <img src="images/icons/hands.png" class="featured-block-image img-fluid" alt="">

                                <p class="featured-block-text">Become a <strong>volunteer</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="#section_3" class="d-block">
                                <img src="images/icons/receive.png" class="featured-block-image img-fluid" alt="">

                                <p class="featured-block-text">Make a <strong>Donation</strong></p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="section-padding section-bg testimonial-section" id="section_charities">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center mb-4">
                        <h2>Charities List</h2>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="charity.html?organization=Kisckstarter%20Foundation">
                                <div class="d-flex align-items-center justify-content-center my-4">
                                    <img src="images/logo.png" alt="charity logo" width="35" height="35"
                                        class="img-fluid me-2">
                                    <h5 class="fs-3 my-auto">Kickstart Hope</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="charity.html?organization=Kisckstarter%20Foundation">
                                <div class="d-flex align-items-center justify-content-center my-4">
                                    <img src="images/logo.png" alt="charity logo" width="35" height="35"
                                        class="img-fluid me-2">
                                    <h5 class="fs-3 my-auto">Kickstart Hope</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="charity.html?organization=Kisckstarter%20Foundation">
                                <div class="d-flex align-items-center justify-content-center my-4">
                                    <img src="images/logo.png" alt="charity logo" width="35" height="35"
                                        class="img-fluid me-2">
                                    <h5 class="fs-3 my-auto">Kickstart Hope</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="charity.html?organization=Kisckstarter%20Foundation">
                                <div class="d-flex align-items-center justify-content-center my-4">
                                    <img src="images/logo.png" alt="charity logo" width="35" height="35"
                                        class="img-fluid me-2">
                                    <h5 class="fs-3 my-auto">Kickstart Hope</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="charity.html?organization=Kisckstarter%20Foundation">
                                <div class="d-flex align-items-center justify-content-center my-4">
                                    <img src="images/logo.png" alt="charity logo" width="35" height="35"
                                        class="img-fluid me-2">
                                    <h5 class="fs-3 my-auto">Kickstart Hope</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="charity.html?organization=Kisckstarter%20Foundation">
                                <div class="d-flex align-items-center justify-content-center my-4">
                                    <img src="images/logo.png" alt="charity logo" width="35" height="35"
                                        class="img-fluid me-2">
                                    <h5 class="fs-3 my-auto">Kickstart Hope</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <div class="d-flex align-items-center justify-content-center my-4">
                                <h5 class="fs-3 my-auto">···</h5>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding " id="section_3">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 text-center mb-4">
                        <h2>Recent Events</h2>
                    </div>
                    <div class="col-lg-12 col-12 text-start ms-4 mb-2">
                        <h5 class="fs-2">Donation</h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <img src="images/causes/240808-olympics-supershoes-nike-se-1200p-734ca1.webp"
                                class="custom-block-image img-fluid" alt="">

                            <div class="custom-block">
                                <div class="custom-block-body">
                                    <h5 class="mb-3">Marathon Sports</h5>

                                    <p>Our volunteers are the heart and soul of our marathon. Your donation will help us show them how much we appreciate their hard work and dedication.</p>
                                    <div class="progress mb-2">
                                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="d-flex align-items-center my-2">
                                        <p class="mb-0">
                                            <strong>Raised:</strong>
                                            $18,500
                                        </p>

                                        <p class="ms-auto mb-0">
                                            <strong>Goal:</strong>
                                            $32,000
                                        </p>
                                    </div>
                                </div>

                                <a href="donate.html?charityName=Hope%20Foundation&eventName=Kickstart%20Hope&raisedAmount=18500&goalAmount=32000&eventImage=images/causes/240808-olympics-supershoes-nike-se-1200p-734ca1.webp" class="custom-btn btn">Donate now</a>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <img src="images/causes/1200px-Alexandra_Engen_2012_London_Olympics_002.jpg"
                                class="custom-block-image img-fluid" alt="">

                            <div class="custom-block">
                                <div class="custom-block-body">
                                    <h5 class="mb-3">Mountain Biking</h5>

                                    <p>Join us in building a stronger mountain biking community! Your donation will help support our dedicated volunteers who work tirelessly to create and maintain the trails we all love. </p>

                                    <div class="progress mt-4">
                                        <div class="progress-bar w-50" role="progressbar" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="d-flex align-items-center my-2">
                                        <p class="mb-0">
                                            <strong>Raised:</strong>
                                            $27,600
                                        </p>

                                        <p class="ms-auto mb-0">
                                            <strong>Goal:</strong>
                                            $60,000
                                        </p>
                                    </div>
                                </div>

                                <a href="donate.html" class="custom-btn btn">Donate now</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 col-12 text-start mt-5 ms-4 mb-2">
                        <h5 class="fs-2">Volunteer</h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="custom-block-wrap">
                            <img src="images/causes/pexels-photo-1263348.webp"
                                class="custom-block-image img-fluid" alt="">

                            <div class="custom-block">
                                <div class="custom-block-body">
                                    <h5 class="mb-3">Freestyle Swimming</h5>

                                    <p>Join our team of dedicated volunteers for an exciting freestyle swimming competition! As a volunteer, you'll play a vital role in ensuring a smooth and successful event. Your tasks may include assisting with registration, timing, and cheering on the swimmers. No experience is necessary, just a willingness to help.</p>

                                    <div class="progress mt-4">
                                        <div class="progress-bar w-100" role="progressbar" aria-valuenow="100"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="d-flex align-items-center my-2">
                                        <p class="mb-0">
                                            <strong>Raised:</strong>
                                            50
                                        </p>

                                        <p class="ms-auto mb-0">
                                            <strong>Goal:</strong>
                                            100
                                        </p>
                                    </div>
                                </div>

                                <a href="volunteer.html" class="custom-btn btn">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="cta-section section-padding section-bg">
            <div class="container">
                <div class="row justify-content-center align-items-center">

                    <div class="col-lg-5 col-12 ms-auto">
                        <h2 class="mb-0">Make an impact. <br> Help Sports Career.</h2>
                    </div>

                    <div class="col-lg-3 col-12">
                        <a href="#section_3" class="custom-btn btn smoothscroll">Make a donation</a>
                    </div>

                    <div class="col-lg-3 col-12">
                        <a href="volunteer.html" class="custom-btn btn">Become a volunteer</a>
                    </div>

                </div>
            </div>
        </section>
        <section class="about-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-5 col-12">
                        <img src="images/ychw.png" class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                    </div>

                    <div class="col-lg-5 col-md-7 col-12">
                        <div class="custom-text-block">
                            <h2 class="mb-0">Chengwei Yan</h2>

                            <p class="text-muted mb-lg-4 mb-md-4">Co-Founding Partner</p>

                            <p>Chengwei Yan is a co-founding partner of Miku Sports Charity Platform. With a strong
                                background in
                                non-profit management, he is dedicated to supporting young athletes and underprivileged
                                communities through sports. Chengwei is passionate about harnessing the power of sports
                                to create positive change and inclusivity. </p>

                            <ul class="social-icon mt-4">
                                <li class="social-icon-item">
                                    <a href="https://twitter.com" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="https://github.com/ChenxiMiku" class="social-icon-link bi-github"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="https://telegram.org" class="social-icon-link bi-telegram"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="section-padding section-bg" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="custom-text-box">
                            <h2 class="mb-2">Our Story</h2>

                            <h5 class="mb-3">Miku Sports Charity Platform, Non-Profit Organization</h5>

                            <p class="mb-0">Miku Sports Charity Platform is a non-profit organization dedicated to
                                making sports
                                accessible to everyone. Founded in 2024, we aim to remove barriers to sports
                                participation for underserved communities.</p>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="custom-text-box mb-lg-0">
                                    <h5 class="mb-3">Our Mission</h5>

                                    <p>At Miku Sports Charity Platform our mission is to let the fun of sports be
                                        accessible to
                                        everyone. We are committed to:</p>

                                    <ul class="custom-list mt-2">
                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Promoting Inclusivity
                                        </li>

                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Recruiting Volunteers
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="custom-text-box d-flex flex-wrap d-lg-block mb-lg-0">
                                    <div class="counter-thumb">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="114"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text"></span>
                                        </div>

                                        <span class="counter-text">Charities</span>
                                    </div>

                                    <div class="counter-thumb mt-4">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="514"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text"></span>
                                        </div>

                                        <span class="counter-text">Events</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="contact-section section-padding" id="section_6">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0">
                        <div class="contact-info-wrap">
                            <h2>Get in touch</h2>

                            <div class="contact-image-wrap d-flex flex-wrap">
                                <img src="images/test/testavatar.png"
                                    class="img-fluid avatar-image" alt="">

                                <div class="d-flex flex-column justify-content-center ms-3">
                                    <p class="mb-0">Wentao Su</p>
                                    <p class="mb-0"><strong>HR & Office Manager</strong></p>
                                </div>
                            </div>

                            <div class="contact-info">
                                <h5 class="mb-3">Contact Infomation</h5>

                                <p class="d-flex mb-2">
                                    <i class="bi-geo-alt me-2"></i>
                                    <a href="https://www.google.com/maps/place/999+Hucheng+Huanlu,+Pudong+New+Area,+Shanghai,+China/@30.8868445,121.8956191,17z/data=!3m1!4b1!4m6!3m5!1s0x35ad768034588f11:0x89d232b593411ad6!8m2!3d30.88684!4d121.90049!16s%2Fg%2F11g4fj_p1x?entry=ttu&g_ep=EgoyMDI0MTAxNi4wIKXMDSoASAFQAw%3D%3D"
                                        class="location-link">
                                        999 Huchenghuan Road, Pudong New District, Shanghai, China
                                    </a>
                                </p>
                                <p class="d-flex mb-2">
                                    <i class="bi-telephone me-2"></i>

                                    <a href="tel: +86 150-9864-6873">
                                        +86 150-9864-6873
                                    </a>
                                </p>

                                <p class="d-flex">
                                    <i class="bi-envelope me-2"></i>

                                    <a href="mailto:info@yourgmail.com">
                                        charity@mikufans.me
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12 mx-auto">
                        <form class="custom-form contact-form" action="#" method="post" role="form">
                            <h2>Contact form</h2>

                            <p class="mb-4">Or, you can just send an email:
                                <a href="#">charity@mikufans.me</a>
                            </p>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="first-name" id="first-name" class="form-control"
                                        placeholder="Hatsune" required>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <input type="text" name="last-name" id="last-name" class="form-control"
                                        placeholder="Miku" required>
                                </div>
                            </div>

                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control"
                                placeholder="HatsuneMiku@mikufans.me" required>

                            <textarea name="message" rows="5" class="form-control" id="message"
                                placeholder="What can we help you?"></textarea>
                            <button type="submit" class="form-control" id="send-button">Send Message</button>
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
                        <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">About us</a></li>
                        <li class="footer-menu-item"><a href="events.php" class="footer-menu-link">Charities</a></li>
                        <li class="footer-menu-item"><a href="dashboard.php" class="footer-menu-link">Dashboard</a></li>
                        <li class="footer-menu-item"><a href="volunteer.php" class="footer-menu-link">Become a volunteer</a></li>
                        <li class="footer-menu-item"><a href="#section_3" class="footer-menu-link">Make a donation</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="site-footer-title mb-3">Contact Information</h5>
                    <p class="text-white d-flex mb-2">
                        <i class="bi-telephone me-2"></i>
                        <a href="tel:<?php $phone ?>" class="site-footer-link">
                            <?php $phone ?>
                        </a>
                    </p>
                    <p class="text-white d-flex">
                        <i class="bi-envelope me-2"></i>
                        <a href="mailto:<?php $email ?>" class="site-footer-link">
                            <?php $email ?>
                        </a>
                    </p>
                    <p class="text-white d-flex mt-3">
                        <i class="bi-geo-alt me-2"></i>
                        <a href="https://www.google.com/maps/place/<?php urlencode($address) ?>" class="site-footer-link">
                            <?php $address ?>
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
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/carousel.js"></script>
    <script src="js/cookies.js"></script>
    <script src="js/darkmode.js"></script>
    <script src="js/click-scroll.js"></script>
</body>

</html>