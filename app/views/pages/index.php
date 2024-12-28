<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>
    <main>
        <section class="hero-section hero-section-full-height">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12 p-0">
                        <div id="hero-slide" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item carousel-item-prev carousel-item-next active">
                                    <img src="../images/slide/1.jpg" class="carousel-image img-fluid" alt="...">
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Enjoy sports</h1>
                                        <p>Let everyone enjoy the fun of sports recording</p>
                                    </div>
                                </div>
                                <div class="carousel-item carousel-item-next carousel-item-prev">
                                    <img src="../images/slide/2.png" class="carousel-image img-fluid" alt="...">
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Non-profit</h1>
                                        <p>You can support us to grow more</p>
                                    </div>
                                </div>
                                <div class="carousel-item carousel-item-next carousel-item-prev">
                                    <img src="../images/slide/3.png" class="carousel-image img-fluid" alt="...">
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
                            <a href="../public/volunteer" class="d-block">
                                <img src="../images/icons/hands.png" class="featured-block-image img-fluid" alt="">

                                <p class="featured-block-text">Become a <strong>volunteer</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="#donation" class="d-block">
                                <img src="../images/icons/receive.png" class="featured-block-image img-fluid" alt="">

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
                    <?php if (!empty($charities)): ?>
                        <?php foreach ($charities as $charity): ?>
                            <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                                <div class="custom-block-wrap">
                                    <a href="charity?organization=<?php echo urlencode($charity['charity_name']) ?>">
                                        <div class="d-flex align-items-center justify-content-center my-4">
                                            <img src="../images/logo.png" alt="<?php echo htmlspecialchars($charity['charity_name']) ?> logo"
                                                width="35" height="35" class="img-fluid me-2">
                                            <h5 class="fs-3 my-auto"><?php echo htmlspecialchars($charity['charity_name']) ?></h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No charities available at the moment.</p>
                    <?php endif; ?>
                    <div class="col-lg-3 col-md-4 col-6 my-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="charities">
                                <div class="d-flex align-items-center justify-content-center my-4">
                                    <h5 class="fs-3 my-auto">···</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding " id="donation">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 text-center mb-4">
                        <h2>Recent Events</h2>
                    </div>
                    <div class="col-lg-12 col-12 text-start ms-4 mb-2">
                        <h5 class="fs-2">Donation</h5>
                    </div>
                    <?php foreach ($donations as $donation): ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block-wrap">
                                <img src="<?php echo htmlspecialchars($donation['image_path']) ?>"
                                    class="custom-block-image img-fluid"
                                    alt="<?php echo htmlspecialchars($donation['title']) ?>">

                                <div class="custom-block">
                                    <div class="custom-block-body">
                                        <h5 class="mb-3"><?php echo htmlspecialchars($donation['title']) ?></h5>

                                        <p><?php echo htmlspecialchars($donation['description']) ?></p>

                                        <div class="progress mb-2">
                                            <?php
                                            $progress = ($donation['current_funding'] / $donation['funding_goal']) * 100;
                                            ?>
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $progress ?>%"
                                                aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <div class="d-flex align-items-center my-2">
                                            <p class="mb-0">
                                                <strong>Raised:</strong>
                                                $<?php echo number_format($donation['current_funding'], 2) ?>
                                            </p>
                                            <p class="ms-auto mb-0">
                                                <strong>Goal:</strong>
                                                $<?php echo number_format($donation['funding_goal'], 2) ?>
                                            </p>
                                        </div>

                                        <a href="charity?organization=<?php echo urlencode($donation['charity_name']) ?>">
                                            By <?php echo htmlspecialchars($donation['charity_name']) ?></a>
                                    </div>

                                    <a href="../public/donation?title=<?php echo urlencode($donation['title']) ?>"
                                        class="custom-btn btn">Donate now</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="col-lg-12 col-12 text-start mt-5 ms-4 mb-2">
                        <h5 class="fs-2">Volunteer</h5>
                    </div>

                    <?php foreach ($volunteerEvents as $event): ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block-wrap">
                                <img src="../images/causes/pexels-photo-1263348.webp"
                                    class="custom-block-image img-fluid"
                                    alt="<?= htmlspecialchars($event['event_name']); ?>">

                                <div class="custom-block">
                                    <div class="custom-block-body">
                                        <h5 class="mb-3"><?= htmlspecialchars($event['event_name']); ?></h5>

                                        <p><?= htmlspecialchars($event['description']); ?></p>

                                        <div class="progress mt-4">
                                            <?php
                                            $progress = ($event['current_volunteers'] / $event['volunteer_goal']) * 100;
                                            ?>
                                            <div class="progress-bar" role="progressbar" style="width: <?= $progress ?>%"
                                                aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <div class="d-flex align-items-center my-2">
                                            <p class="mb-0">
                                                <strong>Volunteers:</strong>
                                                <?= $event['current_volunteers']; ?> / <?= $event['volunteer_goal']; ?>
                                            </p>
                                        </div>
                                        <p class="my-2">
                                            <strong>Date:</strong>
                                            <?= htmlspecialchars($event['event_date']); ?>
                                        </p>
                                        <p class="ms-auto my-2">
                                            <strong>Location:</strong>
                                            <?= htmlspecialchars($event['event_location']); ?>
                                        </p>
                                    
                                        <a href="charity?organization=<?php echo urlencode($event['charity_name']) ?>">
                                            By <?php echo htmlspecialchars($event['charity_name']) ?></a>
                                    </div>
                                    <a href="volunteer?event=<?= urlencode($event['event_name']); ?>"
                                        class="custom-btn btn">Join Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                        <a href="#donation" class="custom-btn btn smoothscroll">Make a donation</a>
                    </div>

                    <div class="col-lg-3 col-12">
                        <a href="../public/volunteer" class="custom-btn btn">Become a volunteer</a>
                    </div>

                </div>
            </div>
        </section>
        <section class="about-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-5 col-12">
                        <img src="../images/ychw.png" class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
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


        <section class="section-padding section-bg">
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
                                            <span class="counter-number" data-from="1" data-to="<?php echo htmlspecialchars($charitiesTotal) ?>"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text"></span>
                                        </div>

                                        <span class="counter-text">Charities</span>
                                    </div>

                                    <div class="counter-thumb mt-4">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="<?php echo htmlspecialchars($eventsTotal) ?>"
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


        <section class="contact-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mb-5 mb-lg-0 justify-content-center">
                        <div class="contact-info-wrap">
                            <h2>Get in touch</h2>

                            <div class="contact-image-wrap d-flex flex-wrap">
                                <img src="../images/test/testavatar.png"
                                    class="img-fluid avatar-image" alt="">

                                <div class="d-flex flex-column justify-content-center ms-3">
                                    <p class="mb-0"><?php echo htmlspecialchars($contactName) ?></p>
                                    <p class="mb-0"><strong>HR & Office Manager</strong></p>
                                </div>
                            </div>

                            <div class="contact-info">
                                <h5 class="mb-3">Contact Infomation</h5>

                                <p class="d-flex mb-2">
                                    <i class="bi-geo-alt me-2"></i>
                                    <a href="<?php echo htmlspecialchars($addressLink) ?>" class="location-link">
                                        <?php echo htmlspecialchars($address) ?>
                                    </a>
                                </p>
                                <p class="d-flex mb-2">
                                    <i class="bi-telephone me-2"></i>

                                    <a href="tel:<?php echo htmlspecialchars($phone) ?>">
                                        <?php echo htmlspecialchars($phone) ?>
                                    </a>
                                </p>

                                <p class="d-flex">
                                    <i class="bi-envelope me-2"></i>
                                    <a href="mailto:<?php echo htmlspecialchars($email) ?>">
                                        <?php echo htmlspecialchars($email) ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include '../app/views/layouts/footer.php'; ?>
    <?php include '../app/views/layouts/cookies.php'; ?>
    <?php include '../app/views/layouts/scroll.php'; ?>
    <script src="js/carousel.js"></script>
    <script src="js/counter.js"></script>
</body>