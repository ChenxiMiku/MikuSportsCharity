<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>
    <main>
        <section class="login-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="col-lg-5 col-12 mx-auto">
                    <form id="loginForm" class="custom-form login-form" action="../public/login" method="POST" role="form">
                        <h3 class="mb-4 d-flex justify-content-center">Welcome Back</h3>

                        <div id="loginError" class="alert alert-danger d-none" role="alert"></div>

                        <div class="col-lg-12 col-12 mb-2">
                            <input type="username" class="form-control" id="username" name="username"
                                placeholder="Enter your usernane" required aria-label="username"
                                autocomplete="username">
                            <div id="usernameError" class="text-danger d-none">Please enter a valid username.</div>
                        </div>

                        <!-- Password input -->
                        <div class="col-lg-12 col-12 mb-2">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required aria-label="Password"
                                autocomplete="current-password">
                            <div id="passwordError" class="text-danger d-none">Password is required.</div>
                        </div>

                        <!-- Submit button -->
                        <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                            <button type="submit" id="SigninBtn" class="custom-btn btn">Login</button>
                        </div>

                        <!-- Sign Up link -->
                        <p class="col-lg-12 col-12 d-flex justify-content-center without-account">No account yet?</p>
                        <a class="col-lg-12 col-12 mb-2 d-flex justify-content-center without-account register-link"
                            href="../public/register">Sign Up</a>

                        <div class="col-lg-12 col-12 mb-2 divider-wrapper">
                            <span class="divider">OR</span>
                        </div>

                        <!-- Social Sign-In buttons -->
                        <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                            <button type="submit" id="googleSignIn" class="custom-btn btn">
                                <i class="bi-google me-2"></i> Continue with Google
                            </button>
                        </div>
                        <div class="col-lg-12 col-12 mb-2 d-flex justify-content-center">
                            <button type="submit" id="githubSignIn" class="custom-btn btn">
                                <i class="bi-github me-2"></i> Continue with Github
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php include '../app/views/layouts/footer.php'; ?>
    <?php include '../app/views/layouts/cookies.php'; ?>
    <script src="../public/js/login.js"></script>
</body>

</html>