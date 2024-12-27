<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>
    <main>
        <section class="section-padding">
            <h1 class="text-center">User Profile</h1>
            <h3 class="text-center">Personalize your profile</h3>
            <div class="container">
                <div class="profile-box">
                    <!-- Profile Header -->
                    <div class="profile-header d-flex align-items-center">
                        <div class="change-avatar-container position-relative">
                            <img id="userAvatar1" alt="User Avatar" class="avatar rounded-circle" width="128" height="128">
                            <input type="file" id="avatarInput" class="d-none" accept="image/*">
                            <div class="change-avatar-overlay position-absolute top-50 start-50 translate-middle">Change</div>
                        </div>
                        <h3 class="ms-3"><span id="userName1">Loading...</span></h3>
                    </div>


                    <!-- Profile Information -->
                    <div class="profile-info mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3>Information</h3>
                            <button id="editButton" class="btn btn-primary">Edit</button>
                        </div>
                        <div id="informationSection" class="info-section">
                            <p><strong>Name:</strong> <span id="name">Loading...</span></p>
                            <p><strong>Email:</strong> <span id="email">Loading...</span></p>
                            <p><strong>Phone:</strong> <span id="phone">Loading...</span></p>
                            <p><strong>Date of Join:</strong> <span id="dateOfJoin">Loading...</span></p>
                            <p><strong>Account Type:</strong> <span id="accountType">Loading...</span></p>
                        </div>
                    </div>

                    <!-- Edit Form -->
                    <div id="editForm" class="edit-form mt-4 d-none">
                        <h3>Edit Information</h3>
                        <form>
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="editName" placeholder="Enter name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="editEmail" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPhone" class="form-label">Phone</label>
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
                                    <input type="tel" class="form-control" id="editPhone" required
                                        maxlength="15" placeholder="Enter phone number">
                                </div>
                                <small class="text-muted" id="phoneHint">&nbsp;</small>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button id="saveButton" class="btn btn-success me-2">Save Changes</button>
                                <button id="cancelButton" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <!-- Divider -->
                    <hr class="my-4">

                    <!-- Change Password Section -->
                    <div id="changePasswordForm" class="change-password">
                        <h3>Change Password</h3>
                        <div id="changePasswordFeedback" class="alert alert-danger d-none"></div>
                        <form>
                            <div>
                                <label for="oldPasswd" class="form-label">Old Password</label>
                                <input type="password" class="form-control" id="oldPasswd" name="oldPasswd" placeholder="Enter your old password" required>
                            </div>
                            <div>
                                <label for="newPasswd" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPasswd" name="newPasswd" placeholder="Enter your new password" required>
                                <small id="passwordFeedback" class="form-text">Password must be at least 8 characters long. Use upper and lower case letters, numbers and symbols for better security.</small>
                                <div class="progress">
                                    <div id="password-strength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small id="passwordStrengthFeedback" class="form-text text-muted">Password must be at least 8 characters long.</small>
                            </div>
                            <div class="my-3">
                                <label for="confirmPasswd" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPasswd" name="confirmPasswd" placeholder="Confirm your new password" required>
                                <small id="confirmPasswordFeedback" class="form-text text-danger">&nbsp;</small>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" id="confirmButton">Change Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include '../app/views/layouts/scroll.php'; ?>
    <script src="js/userprofile.js"></script>
    <script src="js/changeprofile.js"></script>
    <script src="js/changepasswd.js"></script>
</body>

</html>