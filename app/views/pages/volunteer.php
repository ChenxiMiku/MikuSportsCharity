<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>
    <main>
        <section id="event-section" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
                        <div class="section-title text-center">
                            <h2>Register</h2>
                            <p>Register to become a volunteer</p>
                        </div>
                    </div>
                    <h3>Select one or more upcoming events you would like to participate in.</h3>
                    <h4>Upcoming Events</h4>
                    <?php foreach ($volunteerEvents as $event): ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block-wrap event-block">
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

                                        <p>
                                            <strong>By:</strong>
                                            <a href="charity.php?organization=<?= urlencode($event['charity_name']) ?>">
                                                <?= htmlspecialchars($event['charity_name']); ?>
                                            </a>
                                        </p>
                                    </div>
                                    <!-- Checkbox instead of Join Now button -->
                                    <div class="custom-checkbox-wrapper d-flex justify-content-center align-items-center mb-5">
                                        <input type="checkbox" id="event<?= $event['event_id']; ?>" name="selected_events[]" value="<?= $event['event_id']; ?>" class="custom-checkbox-input">
                                        <label for="event<?= $event['event_id']; ?>" class="custom-checkbox-label"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-end">
                        <button class="col-lg-2 col-md-2 col-12 mt-4 custom-btn" id="nextBtn" disabled>Next</button>
                    </div>
                </div>
            </div>
        </section>

        <section id="form-section" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="section-title text-center">
                            <h2>Volunteer Registration Form</h2>
                            <p>Please fill out the form to complete your registration.</p>
                        </div>
                        <form id="volunteerForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" required pattern="^[\p{L}\s\-]+$"
                                    maxlength="50"
                                    title="Name can contain any language characters, spaces, and hyphens, and should not exceed 50 characters.">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required maxlength="100"
                                    title="Please enter a valid email address (e.g., user@example.com).">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <div class="d-flex align-items-center">
                                    <!-- Country Code Dropdown -->
                                    <select id="countryCode" class="form-select me-2" style="max-width: 120px;" required>
                                        <option value="+1" data-pattern="^\d{10}$">+1 (US)</option>
                                        <option value="+44" data-pattern="^\d{10}$">+44 (UK)</option>
                                        <option value="+91" data-pattern="^\d{10}$">+91 (India)</option>
                                        <option value="+86" data-pattern="^\d{11}$">+86 (China)</option>
                                        <option value="+81" data-pattern="^\d{10}$">+81 (Japan)</option>
                                        <option value="+33" data-pattern="^\d{9}$">+33 (France)</option>
                                        <!-- Add more countries as needed -->
                                    </select>

                                    <!-- Phone Number Input -->
                                    <input type="tel" class="form-control" id="phone" required
                                        maxlength="15" placeholder="Enter phone number">
                                </div>
                                <small class="form-text text-muted">
                                    Select your country code and enter your phone number.
                                </small>
                            </div>


                            <!-- Dynamically filled event times -->
                            <div id="selected-events"></div>

                            <div class="col-lg-12 col-md-12 col-12 my-4 mb-lg-0 d-flex justify-content-center">
                                <button class="col-lg-4 col-5 mb-4 me-auto custom-btn"
                                    id="previousBtn">Previous</button>
                                <button type="submit" class="col-lg-4 col-5 mb-4 ms-auto custom-btn"
                                    id="submitBtn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Submitted Section -->
        <section id="submitted-section" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="section-title text-center">
                            <h2>Thank You for Your Registration!</h2>
                            <p>Your submission has been received. Below are your registration details:</p>
                        </div>
                        <div id="submitted-details"></div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="index.php" class="col-lg-2 col-md-2 col-12 mt-4 custom-btn text-center">Back to
                            Home</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include '../app/views/layouts/footer.php'; ?>
    <?php include '../app/views/layouts/cookies.php'; ?>
    <?php include '../app/views/layouts/overlay.php'; ?>
    <script src="../public/js/volunteer.js"></script>
</body>

</html>