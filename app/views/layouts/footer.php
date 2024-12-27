<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 mb-4">
                <img src="../images/logo.png" class="logo img-fluid" alt="">
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <h5 class="site-footer-title mb-3">Quick Links</h5>
                <ul class="footer-menu">
                    <li class="footer-menu-item"><a href="../public/about" class="footer-menu-link">About us</a></li>
                    <li class="footer-menu-item"><a href="../public/charities" class="footer-menu-link">Charities</a></li>
                    <li class="footer-menu-item"><a href="../public/profile" class="footer-menu-link">My profile</a></li>
                    <li class="footer-menu-item"><a href="../public/volunteer" class="footer-menu-link">Become a volunteer</a></li>
                    <li class="footer-menu-item"><a href="#section_3" class="footer-menu-link">Make a donation</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mx-auto">
                <h5 class="site-footer-title mb-3">Contact Information</h5>
                <p class="text-white d-flex mb-2">
                    <i class="bi-telephone me-2"></i>
                    <a href="tel:<?php echo htmlspecialchars($phone) ?>" class="site-footer-link">
                        <?php echo htmlspecialchars($phone) ?>
                    </a>
                </p>
                <p class="text-white d-flex">
                    <i class="bi-envelope me-2"></i>
                    <a href="mailto:<?php echo htmlspecialchars($email) ?>" class="site-footer-link">
                        <?php echo htmlspecialchars($email) ?>
                    </a>
                </p>
                <p class="text-white d-flex mt-3">
                    <i class="bi-geo-alt me-2"></i>
                    <a href="<?php echo htmlspecialchars($addressLink) ?>" class="site-footer-link">
                        <?php echo htmlspecialchars($address) ?>
                    </a>
                </p>
            </div>
        </div>
    </div>

    <div class="site-footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7 col-12 align-items-center d-flex">
                    <p class="copyright-text mb-0 align-items-center">
                        Copyright © 2024 <a href="#">Miku Sports</a> Charity Org.
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
