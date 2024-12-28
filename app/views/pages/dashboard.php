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
                                <button class="nav-link" id="publish-activities-tab" data-bs-toggle="tab" data-bs-target="#manage-activities" type="button" role="tab">Manage Activities</button>
                            </li>
                        </ul>

                        <div class="tab-content mt-4" id="dashboardTabsContent">
                            <!-- Manage Charities -->
                            <div class="tab-pane fade show active" id="manage-charities" role="tabpanel">
                                <h3>Manage Charities</h3>
                                <button class="btn btn-primary mb-3" id="addCharityButton">Add New Charity</button>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id="charityList">
                                        <?php foreach ($charities as $charity): ?>
                                            <tr data-id="<?= $charity['charity_id']; ?>">
                                                <td><?= htmlspecialchars($charity['charity_name']); ?></td>
                                                <td class="text-end">
                                                    <button class="editBtn btn btn-primary me-3 btn-sm">Edit</button>
                                                    <button class="deleteBtn btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Activities -->
                            <div class="tab-pane fade" id="manage-activities" role="tabpanel">
                                <h3>Manage Activities</h3>
                                <!-- Activity List -->
                                <table class="table table-striped mt-4" id="activityList">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Charity Name</th>
                                            <th>Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Activity rows will be dynamically added here -->
                                    </tbody>
                                </table>

                                <!-- Activity Form -->
                                <h4 id="formTitle">Add New Activity</h4>
                                <form id="publishActivityForm">
                                    <input type="hidden" id="activityId" value="">
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
                                                    <input type="time" class="form-control d-inline-block w-45 mb-3" name="start_time" required>
                                                    <small class="d-inline-block mx-2">End time</small>
                                                    <input type="time" class="form-control d-inline-block w-45 mb-3" name="end_time" required>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeTimeSlot(this)">Remove</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm mt-2" id="addTimeSlot">Add Time Slot</button>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <button type="submit" class="btn btn-primary me-3" id="submitBtn">Save Activity</button>
                                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                                </form>
                            </div>
                        </div>

                        <div class="modal" id="addCharityModal" tabindex="-1" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addCharityModalLabel">Add New Charity</h5>
                                        <button type="button" class="btn-close" id="closeModalButton"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addCharityForm">
                                            <div class="mb-3">
                                                <label for="charityNameInput" class="form-label">Charity Name</label>
                                                <input type="text" class="form-control" id="charityNameInput" required>
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
</body>

</html>