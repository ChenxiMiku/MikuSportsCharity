<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>
    <main>
        <section class="login-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="col-lg-6 col-12 mx-auto">
                    <form class="custom-form login-form register-form" id="registerForm" action="../public/register" method="post" role="form">
                        <h3 class="mb-4 d-flex justify-content-center">Create an Account</h3>

                        <!-- Error or Success Message -->
                        <div id="registerFeedback" class="alert alert-danger d-none"></div>

                        <div class="row">
                            <!-- Username Field -->
                            <div class="col-lg-12 col-12">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter your username" aria-label="Username" required>                                
                                <small id="usernameFeedback" class="form-text text-danger">&nbsp;</small>
                            </div>

                            <!-- Email Field -->
                            <div class="col-lg-12 col-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email address" aria-label="Email" required>                                
                                <small id="emailFeedback" class="form-text text-danger">&nbsp;</small>
                            </div>

                            <!-- Password Field -->
                            <div class="col-lg-12 col-12">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" aria-label="Password" required autocomplete="new-password">
                                    <small id="passwordFeedback" class="form-text">Password must be at least 8 characters long. Use upper and lower case letters, numbers and symbols for better security.</small>
                                <div class="progress">
                                    <div id="password-strength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small id="passwordStrengthFeedback" class="form-text text-muted">Password must be at least 8 characters long.</small>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="col-lg-12 col-12">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                    placeholder="Confirm Password" aria-label="Confirm Password" required autocomplete="new-password">                                
                                <small id="confirmPasswordFeedback" class="form-text text-danger">&nbsp;</small>
                            </div>


                            <!-- Register Button -->
                            <div class="col-lg-12 col-12 my-3 d-flex justify-content-center">
                                <button type="submit" id="SignupBtn" class="custom-btn btn" disabled>Sign Up</button>
                            </div>

                            <!-- Already have an account Link -->
                            <p class="col-lg-12 col-12 d-flex justify-content-center without-account">Already have an account?</p>
                            <a class="col-lg-12 col-12 mb-2 d-flex justify-content-center without-account login-link" href="../public/login">Log In</a>

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
    <?php include '../app/views/layouts/footer.php'; ?>
    <?php include '../app/views/layouts/cookies.php'; ?>
    <script src="../public/js/register.js"></script>
</body>

</html>