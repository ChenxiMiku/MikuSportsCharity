<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>

    <main>
        <section class="events-section section-padding" id="section_5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mb-5">
                        <h1>Charity</h1>
                    </div>
                    <div class="col-lg-9 col-12" id="charity-events-container">
                        <!-- Dynamically load news -->
                    </div>

                    <div class="col-lg-3 col-12 mx-auto">
                        <form class="custom-form search-form d-flex align-items-center" action="#" method="get"
                            role="form">
                            <input type="search" class="form-control my-auto" id="search" name="search"
                                placeholder="Search" required aria-label="Search">
                            <button type="submit" class="search-btn btn">
                                <i class="bi-search"></i>
                            </button>
                        </form>


                        <div class="tags-block mt-5">
                            <div class="tags-block-title d-flex mb-3">
                                <i class="ms-2 bi-tags my-auto custom-icon-primary"></i>
                                <h5 class="ms-1 my-auto">Tags</h5>
                                <a class="tags-block-title my-auto mx-auto" id="clear-selection">Clear All</a>
                            </div>
                            <a href="#" class="tags-block-link" data-tag="Donation">Donation</a>
                            <a href="#" class="tags-block-link" data-tag="Volunteer">Volunteer</a>
                            <a href="#" class="tags-block-link" data-tag="Football">Football</a>
                            <a href="#" class="tags-block-link" data-tag="Basketball">Basketball</a>
                            <a href="#" class="tags-block-link" data-tag="Badminton">Badminton</a>
                            <a href="#" class="tags-block-link" data-tag="Education">Education</a>
                        </div>

                    </div>

                </div>
            </div>
        </section>

    </main>

    <?php include '../app/views/layouts/footer.php'; ?>
    <?php include '../app/views/layouts/scroll.php'; ?>
    <?php include '../app/views/layouts/cookies.php'; ?>
    <script src="js/search.js"></script>
    <script src="js/charityevents.js"></script>

</body>

</html>