<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 检查用户是否登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 模拟从会话或数据库获取用户信息
$user_name = $_SESSION['user_name'] ?? "Guest";
$user_email = $_SESSION['user_email'] ?? "charity@mikufans.me";
$user_phone = $_SESSION['user_phone'] ?? "0123456789";
$date_of_join = $_SESSION['date_of_join'] ?? "2020-11-13";
$account_type = $_SESSION['account_type'] ?? "User";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dashboard">
    <meta name="author" content="Chengwei Yan 694659">
    <meta name="author" content="Wentao Su 694641">
    <meta name="author" content="Ruilin Hu 694498">
    <meta name="author" content="Wentai Ge 694640">
    <title>Miku Sports Charity Platform - Dashboard</title>

    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="favicon.png" type="image/png">
</head>

<body id="section_1">

    <!-- Header Section -->
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i class="bi-geo-alt me-2"></i>
                        999 Huchenghuan Road, Pudong New District, Shanghai, China
                    </p>
                    <p class="d-flex mb-0">
                        <i class="bi-envelope me-2"></i>
                        <a href="mailto:charity@mikufans.me">charity@mikufans.me</a>
                    </p>
                </div>
                <div class="col-lg-3 col-12 ms-auto d-lg-block">
                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="https://github.com/ChenxiMiku/MikuSportsCharity"
                                class="social-icon-link bi-github"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="user-dashboard">
            <div class="page-content index-page">
                <div class="sidebar">
                    <div class="brand">
                        <i class="fa-solid fa-xmark xmark"></i>
                        <p class="d-flex mb-0">
                            <a href="index.php">
                                <img src="images/logo.png" class="logo-small img-fluid"
                                    alt="Miku Sports Charity Platform">
                            </a>
                        </p>

                    </div>
                    <ul>
                        <li id="Dashboard-Side">
                            <a class="sidebar-link">
                                <i class="fa-regular bi-speedometer2 fa-fw"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li id="Profile-Side">
                            <a class="sidebar-link">
                                <i class="fa-regular bi-person fa-fw"></i><span>Profile</span>
                            </a>
                        </li>

                        <li id="Donation-Side">
                            <a class="sidebar-link">
                                <i class="fa-solid bi-wallet2 fa-fw"></i><span>Donation</span>
                            </a>
                        </li>

                        <li id="Events-Side">
                            <a class="sidebar-link">
                                <i class="fa-solid bi-calendar2-event fa-fw"></i><span>Events</span>
                            </a>
                        </li>
                    </ul>
                    <div class="col-lg-12 col-md-12 col-12 text-center">
                        <p>Copyright © 2024 <br><a href="index.php">Miku Sports </a>Org.
                        </p>
                    </div>
                </div>
                <main id="Dashboard">
                    <nav class="header navbar navbar-expand-lg">

                        <i class="fa-solid fa-bars bar-item"></i>
                        <div class="title">
                            <h5 class="fs-1">Dashboard</h5>
                        </div>
                        <div class="d-flex">
                            <div id="userAvatar" class="dropdown avatar-image me-5">
                                <a class="dropdown-toggle" href="#"">
                                        <img id=" avatarImg" src="images/test/testavatar.png" alt="User Avatar"
                                    width="64" height="64" class="rounded-circle">
                                </a>

                                <div class="dropdown-menu" aria-labelledby="avatarDropdown">
                                    <a class="dropdown-item align-items-center" href="index.php">
                                        <i class="bi-house me-2"></i>Homepage
                                    </a>

                                    <a class="dropdown-item align-items-center" href="admin.html">
                                        <i class="bi-person-badge me-2"></i>Admin
                                    </a>

                                    <a class="dropdown-item align-items-center logoutBtn" href="login.php">
                                        <i class="bi-box-arrow-right me-2"></i>Log out
                                    </a>
                                </div>
                            </div>
                            <div class="mx-auto my-auto">
                                <button class="btn btn-outline-secondary darkModeToggle">
                                    <i class="fas bi-moon-fill"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                    <div class="main-content">
                        <div class="main-content-boxes">
                            <div class="box first-box">
                                <div class="box-section1">
                                    <div class="box-title">
                                        <h4>Welcome</h4>
                                        <h4>Miku</h4>
                                    </div>
                                    <div class="box-image">
                                        <img src="./images/welcome.png" alt="No image" />
                                    </div>
                                    <img src="./images/avatar.png" alt="No image" class="avatar" id="avatar2" />
                                </div>
                                <div class="box-section2 mx-4">
                                    <p>Welcome to Miku Sports Charity Platform. Let the Fun of Sports Be Accessible
                                        to
                                        Everyone.</p>
                                </div>
                                <div class="box-section2 my-auto">
                                    <ul>
                                        <li>
                                            <span>Miku</span>
                                            <p>User</p>
                                        </li>
                                        <li>
                                            <span>80</span>
                                            <p>Volunteer</p>
                                        </li>
                                        <li>
                                            <span>$8500</span>
                                            <p>Donated</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="box">
                                <div class="box-section1">
                                    <div class="box-title">
                                        <h3>Latest Volunteer Events</h3>
                                    </div>
                                </div>
                                <div class="latest-news-section2">
                                    <img src="./images/news-01.png" alt="" />
                                    <div class="latest-news-section2-info">
                                        <h4>Event 1</h4>
                                        <p>Sample</p>
                                    </div>
                                    <span>3 Days Ago</span>
                                </div>

                                <div class="latest-news-section2">
                                    <img src="./images/news-02.png" alt="" />
                                    <div class="latest-news-section2-info">
                                        <h4>Event 2</h4>
                                        <p>Sample</p>
                                    </div>
                                    <span>5 Days Ago</span>
                                </div>

                                <div class="latest-news-section2">
                                    <img src="./images/news-03.png" alt="" />
                                    <div class="latest-news-section2-info">
                                        <h4>Event 3</h4>
                                        <p>Sample</p>
                                    </div>
                                    <span>7 Days Ago</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="projects-box">
                        <div class="box-section1">
                            <div class="box-title">
                                <h3>Latest Donation</h3>
                            </div>
                        </div>
                        <div class="donation-container">
                            <div class="ViewWrapper donation-shadow">
                                <div class="ant-table-body">
                                    <table class="ant-table">
                                        <colgroup>
                                            <col class="width-270">
                                            <col class="width-250">
                                            <col class="width-150">
                                        </colgroup>
                                        <thead class="ant-table-thead ant-table-row">
                                            <tr>
                                                <th class="ant-table-cell">Bill ID</th>
                                                <th class="ant-table-cell">Beneficiary</th>
                                                <th class="ant-table-cell">Frequency</th>
                                                <th class="ant-table-cell">Amount</th>
                                                <th class="ant-table-cell">Status</th>
                                                <th class="ant-table-cell">Created At</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="ant-table">
                                        <colgroup>
                                            <col class="width-270">
                                            <col class="width-250">
                                            <col class="width-150">
                                        </colgroup>
                                        <tbody class="ant-table-tbody">
                                            <!-- Row 1 -->
                                            <tr class="ant-table-row ant-table-row-level-0">
                                                <td class="ant-table-cell">
                                                    2024102701103995789598385</td>
                                                <td class="ant-table-cell">Event1</td>
                                                <td class="ant-table-cell">Monthly</td>
                                                <td class="ant-table-cell">4.50</td>
                                                <td class="ant-table-cell">Canceled</td>
                                                </td>
                                                <td class="ant-table-cell">2024-10-27 01:35:39
                                                </td>
                                            </tr>

                                            <!-- Row 2 -->
                                            <tr class="ant-table-row ant-table-row-level-0">
                                                <td class="ant-table-cell">
                                                    2024101121102516150995191</td>
                                                <td class="ant-table-cell">Even2</td>
                                                <td class="ant-table-cell">One Time</td>
                                                <td class="ant-table-cell">1.00</td>
                                                <td class="ant-table-cell">Completed</td>
                                                <td class="ant-table-cell">2024-10-11 21:25:25
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>
                <main id="Profile" hidden>
                    <nav class="header navbar navbar-expand-lg">

                        <i class="fa-solid fa-bars bar-item"></i>
                        <div class="title">
                            <h5 class="fs-1">Profile</h5>
                        </div>
                        <div class="d-flex">
                            <div id="userAvatar" class="dropdown avatar-image me-5">
                                <a class="dropdown-toggle" href="#"">
                                        <img id=" avatarImg" src="images/test/testavatar.png" alt="User Avatar"
                                    width="64" height="64" class="rounded-circle">
                                </a>

                                <div class="dropdown-menu" aria-labelledby="avatarDropdown">
                                    <a class="dropdown-item align-items-center" href="index.php">
                                        <i class="bi-house me-2"></i>Homepage
                                    </a>

                                    <a class="dropdown-item align-items-center" href="admin.html">
                                        <i class="bi-person-badge me-2"></i>Admin
                                    </a>

                                    <a class="dropdown-item align-items-center logoutBtn" href="login.php">
                                        <i class="bi-box-arrow-right me-2"></i>Log out
                                    </a>
                                </div>
                            </div>
                            <div class="mx-auto my-auto">
                                <button class="btn btn-outline-secondary darkModeToggle">
                                    <i class="fas bi-moon-fill"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                    <div class="main-content">
                        <div class="profile-box">
                            <div class="profile-info">
                                <div class="change-avatar-container">
                                    <img src="../images/avatar.png" id="avatar5" class="change-avatar"
                                        alt="Avatar 5">

                                    <div class="change-avatar-overlay">Change</div>
                                </div>
                                <input type="file" id="avatarInput" hidden accept="image/*">
                                <h4>Miku</h4>
                                <p>Level 20</p>
                                <p>550 Ratings</p>
                            </div>
                            <div class="profile-info-section2">
                                <div class="container" id="informationSection">
                                    <div class="row mx-2 my-2">
                                        <h3 class="d-flex justify-content-between align-items-center">
                                            Information
                                            <button id="editButton" class="btn edit-btn my-auto">Edit</button>
                                        </h3>

                                        <div class="col-lg-12 col-12 mb-1">
                                            <h7>UserName:</h7>
                                            <p class="fw-normal ms-2" id="userName">Miku</p>
                                        </div>

                                        <div class="col-lg-12 col-12 mb-1">
                                            <h7>Email:</h7>
                                            <p class="fw-normal ms-2" id="email">charity@mikufans.me</p>
                                        </div>

                                        <div class="col-lg-12 col-12 mb-1">
                                            <h7>Phone:</h7>
                                            <p class="fw-normal ms-2" id="phone">0123456789</p>
                                        </div>

                                        <div class="col-lg-12 col-12 mb-1">
                                            <h7>Date of Join:</h7>
                                            <p class="fw-normal ms-2" id="dateOfJoin">2020-11-13</p>
                                        </div>

                                        <div class="col-lg-12 col-12 mb-1">
                                            <h7>Account Type:</h7>
                                            <p class="fw-normal ms-2" id="accountType">Admin</p>
                                        </div>
                                    </div>
                                </div>

                                <div id="editForm" class="pt-2">
                                    <div class="row mx-2 my-2">
                                        <h3>Edit Information</h3>
                                        <h7 class="mt-2">Userame</h7>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <input type="text" class="form-control" id="editUserName" name="editUserName" placeholder="Enter username" required>
                                        </div>

                                        <h7>Email</h7>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <input type="email" class="form-control" id="editEmail" name="editEmail" placeholder="Enter your email" required>
                                        </div>

                                        <h7>Phone</h7>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <input type="text" class="form-control" id="editPhone" name="editPhone" placeholder="Enter your phone number" required>
                                        </div>

                                        <h7>Date of Join</h7>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <input type="date" class="form-control" id="editDateOfJoin" name="editDateOfJoin" required>
                                        </div>

                                        <h7>Account Type</h7>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <input type="text" class="form-control" id="editAccountType" name="editAccountType" placeholder="Enter account type" required>
                                        </div>

                                        <div class="col-lg-12 col-12 mb-3">
                                            <button id="saveButton" class="btn btn-primary ms-auto fs-6">Save Changes</button>
                                            <button id="cancelButton" class="btn btn-secondary fs-6">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12 mb-2 divider-wrapper"></div>
                                <div class="container ">

                                    <div class="row mx-2 my-2">

                                        <h3>Change Password</h3>
                                        <h7 class="mt-2">Old Password</h7>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <input type="password" class="form-control" id="oldPasswd"
                                                name="oldPasswd" placeholder="Enter your old password" required>
                                        </div>
                                        <h7>New Password</h7>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <input type="password" class="form-control" id="newPasswd"
                                                name="newPasswd" placeholder="Enter your old password" required>
                                        </div>
                                        <h7>Confirm New Password</h7>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <input type="password" class="form-control" id="confirmPasswd"
                                                name="confirmPasswd" placeholder="Confirm your new password"
                                                required>
                                        </div>
                                        <div class="col-lg-12 col-12 mb-3">
                                            <button class="changepasswd-btn btn ms-auto fs-6"
                                                id="confirmButton">Change
                                                Password</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </main>
                <main id="Events" hidden>
                    <nav class="header navbar navbar-expand-lg">

                        <i class="fa-solid fa-bars bar-item"></i>
                        <div class="title">
                            <h5 class="fs-1">My Volunteer Events</h5>
                        </div>
                        <div class="d-flex">
                            <div id="userAvatar" class="dropdown avatar-image me-5">
                                <a class="dropdown-toggle" href="#"">
                                        <img id=" avatarImg" src="images/test/testavatar.png" alt="User Avatar"
                                    width="64" height="64" class="rounded-circle">
                                </a>

                                <div class="dropdown-menu" aria-labelledby="avatarDropdown">
                                    <a class="dropdown-item align-items-center" href="index.php">
                                        <i class="bi-house me-2"></i>Homepage
                                    </a>

                                    <a class="dropdown-item align-items-center" href="admin.html">
                                        <i class="bi-person-badge me-2"></i>Admin
                                    </a>

                                    <a class="dropdown-item align-items-center logoutBtn" href="login.php">
                                        <i class="bi-box-arrow-right me-2"></i>Log out
                                    </a>
                                </div>
                            </div>
                            <div class="mx-auto my-auto">
                                <button class="btn btn-outline-secondary darkModeToggle">
                                    <i class="fas bi-moon-fill"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                    <div class="main-content">
                        <div class="col-lg-12 col-12" id="charity-events-container">

                        </div>
                    </div>
                </main>
                <main id="Donation" hidden>
                    <nav class="header navbar navbar-expand-lg">

                        <i class="fa-solid fa-bars bar-item"></i>
                        <div class="title">
                            <h5 class="fs-1">My Donation</h5>
                        </div>
                        <div class="d-flex">
                            <div id="userAvatar" class="dropdown avatar-image me-5">
                                <a class="dropdown-toggle" href="#"">
                                        <img id=" avatarImg" src="images/test/testavatar.png" alt="User Avatar"
                                    width="64" height="64" class="rounded-circle">
                                </a>

                                <div class="dropdown-menu" aria-labelledby="avatarDropdown">
                                    <a class="dropdown-item align-items-center" href="index.php">
                                        <i class="bi-house me-2"></i>Homepage
                                    </a>

                                    <a class="dropdown-item align-items-center" href="admin.html">
                                        <i class="bi-person-badge me-2"></i>Admin
                                    </a>

                                    <a class="dropdown-item align-items-center logoutBtn" href="login.php">
                                        <i class="bi-box-arrow-right me-2"></i>Log out
                                    </a>
                                </div>
                            </div>
                            <div class="mx-auto my-auto">
                                <button class="btn btn-outline-secondary darkModeToggle">
                                    <i class="fas bi-moon-fill"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                    <div class="main-content">
                        <div class="donation-container">
                            <div class="ViewWrapper donation-shadow">
                                <div class="ant-table-body">
                                    <table class="ant-table">
                                        <colgroup>
                                            <col class="width-270">
                                            <col class="width-250">
                                            <col class="width-150">
                                        </colgroup>
                                        <thead class="ant-table-thead ant-table-row">
                                            <tr>
                                                <th class="ant-table-cell">Bill ID</th>
                                                <th class="ant-table-cell">Beneficiary</th>
                                                <th class="ant-table-cell">Frequency</th>
                                                <th class="ant-table-cell">Amount</th>
                                                <th class="ant-table-cell">Status</th>
                                                <th class="ant-table-cell">Created At</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="ant-table">
                                        <colgroup>
                                            <col class="width-270">
                                            <col class="width-250">
                                            <col class="width-150">
                                        </colgroup>
                                        <tbody class="ant-table-tbody">
                                            <!-- Row 1 -->
                                            <tr class="ant-table-row ant-table-row-level-0">
                                                <td class="ant-table-cell">
                                                    2024102701103995789598385</td>
                                                <td class="ant-table-cell">Event1</td>
                                                <td class="ant-table-cell">Monthly</td>
                                                <td class="ant-table-cell">4.50</td>
                                                <td class="ant-table-cell">Canceled</td>
                                                </td>
                                                <td class="ant-table-cell">2024-10-27 01:35:39
                                                </td>
                                            </tr>

                                            <!-- Row 2 -->
                                            <tr class="ant-table-row ant-table-row-level-0">
                                                <td class="ant-table-cell">
                                                    2024101121102516150995191</td>
                                                <td class="ant-table-cell">Even2</td>
                                                <td class="ant-table-cell">One Time</td>
                                                <td class="ant-table-cell">1.00</td>
                                                <td class="ant-table-cell">Completed</td>
                                                <td class="ant-table-cell">2024-10-11 21:25:25
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>

            </div>
            <div class="loader">
                <h1>Loading<span>....</span></h1>
            </div>

        </section>
    </main>

    <button id="scrollToTopBtn" class="scroll-to-top" aria-label="Scroll to top">
        <i class="bi bi-arrow-up-circle"></i>
    </button>

    <!-- JAVASCRIPT FILES -->
    <script src="js/dashboardjs.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/joinedevents.js"></script>
    <script src="js/checklogin.js"></script>
    <script src="js/darkmode.js"></script>
    <script src="js/changepasswd.js"></script>
    <script src="js/userprofile.js"></script>
</body>

</html>