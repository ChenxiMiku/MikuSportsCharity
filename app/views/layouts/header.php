<header class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12 d-flex flex-wrap">
                <p class="d-flex me-4 mb-0">
                    <i class="bi-geo-alt me-2"></i>
                    <a href="<?php echo htmlspecialchars($addressLink) ?>" class="site-footer-link">
                        <?php echo htmlspecialchars($address); ?>
                    </a>
                </p>
                <p class="d-flex mb-0">
                    <i class="bi-envelope me-2"></i>
                    <a href="mailto:<?php echo htmlspecialchars($email); ?>">
                        <?php echo htmlspecialchars($email); ?>
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
