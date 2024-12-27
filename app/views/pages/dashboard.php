<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>
    <main>
        <section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <h1 class="text-center mb-5">Charity Management Dashboard</h1>

                        <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="manage-charities-tab" data-bs-toggle="tab" data-bs-target="#manage-charities" type="button" role="tab">Manage Charities</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="publish-activities-tab" data-bs-toggle="tab" data-bs-target="#publish-activities" type="button" role="tab">Publish Activities</button>
                            </li>
                        </ul>

                        <div class="tab-content mt-4" id="dashboardTabsContent">
                            <!-- Manage Charities -->
                            <div class="tab-pane fade show active" id="manage-charities" role="tabpanel">
                                <h3>Manage Charities</h3>
                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCharityModal">Add New Charity</button>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id="charityList">
                                    </tbody>
                                </table>
                            </div>

                            <!-- Publish Activities -->
                            <div class="tab-pane fade" id="publish-activities" role="tabpanel">
                                <h3>Publish New Activities</h3>
                                <form id="publishActivityForm">
                                    <div class="mb-3">
                                        <label for="activityTitle" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="activityTitle" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="charityName" class="form-label">Charity Name</label>
                                        <input type="text" class="form-control" id="charityName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="activityDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="activityDescription" rows="4" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="activityImage" class="form-label">Upload Image</label>
                                        <input type="file" class="form-control" id="activityImage" accept="image/*" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="activityType" class="form-label">Type</label>
                                        <select class="form-select" id="activityType" required>
                                            <option value="">Select Type</option>
                                            <option value="donation">Donation</option>
                                            <option value="volunteer">Volunteer</option>
                                        </select>
                                    </div>
                                    <!-- Donation-specific fields -->
                                    <div id="donationFields" class="d-none">
                                        <div class="mb-3">
                                            <label for="fundingGoal" class="form-label">Funding Goal</label>
                                            <input type="number" class="form-control" id="fundingGoal" min="0">
                                        </div>
                                    </div>
                                    <!-- Volunteer-specific fields -->
                                    <div id="volunteerFields" class="d-none">
                                        <div class="mb-3">
                                            <label for="eventDate" class="form-label">Event Date</label>
                                            <input type="date" class="form-control" id="eventDate">
                                        </div>
                                        <div class="mb-3">
                                            <label for="eventLocation" class="form-label">Event Location</label>
                                            <input type="text" class="form-control" id="eventLocation">
                                        </div>
                                        <div class="mb-3">
                                            <label for="volunteerGoal" class="form-label">Volunteer Goal</label>
                                            <input type="number" class="form-control" id="volunteerGoal" min="0">
                                        </div>
                                        <div class="mb-3">
                                            <label for="timeSlots" class="form-label">Time Slots</label>
                                            <div id="timeSlots">
                                                <div class="time-slot">
                                                    <small class="d-inline-block mx-2">Start time</small>
                                                    <input type="time" class="form-control d-inline-block w-45 mb-3" required>
                                                    <small class="d-inline-block mx-2">End time</small>
                                                    <input type="time" class="form-control d-inline-block w-45 mb-3" required>
                                                    <button type="button" class="btn btn-danger btn-sm " onclick="removeTimeSlot(this)">Remove</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm mt-2" id="addTimeSlot">Add Time Slot</button>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="col-lg-12 col-md-12 col-12 my-4 mb-lg-0 d-flex justify-content-center">
                                        <button type="submit" class="col-lg-4 col-5 mb-4 custom-btn"
                                            id="submitBtn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Add Charity Modal -->
                    <div class="modal fade" id="addCharityModal" tabindex="-1" aria-labelledby="addCharityModalLabel" inert>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCharityModalLabel">Add New Charity</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addCharityForm">
                                        <div class="mb-3">
                                            <label for="charityName" class="form-label">Charity Name</label>
                                            <input type="text" class="form-control" id="charityName" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Charity</button>
                                    </form>
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

    <script src="js/dashboard.js"></script>
    <script src="js/db1.js"></script>
    <script src="js/db2.js"></script>
</body>

</html>