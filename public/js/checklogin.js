document.addEventListener("DOMContentLoaded", function () {
    const logoutButtons = document.querySelectorAll(".logoutBtn");
    const loginBtn = document.getElementById("loginBtn");
    const userAvatar = document.getElementById("userAvatar");
    const userName = document.getElementById("userName");
    const loginOverlay = document.getElementById("loginOverlay");
    const dashboardItem = document.getElementById("dashboardItem");
    const publicCheckbox = document.getElementById("donation-public");
    loginBtn.style.display = "none";
    async function verifyLogin() {
        try {
            const response = await fetch("../public/api/verifyLogin", {
                method: "GET",
                credentials: "include",
            });
            const data = await response.json();
            return data.success ? data : null;
        } catch (error) {
            console.error("Error verifying token:", error);
            return null;
        }
    }

    async function updateUI() {
        const userData = await verifyLogin();

        if (window.location.pathname.endsWith("/login") && userData) {
            window.location.href = "../public/";
        }

        if (userData) {
            if(loginOverlay) loginOverlay.style.display = "none";
            if(userData.role === "admin" && dashboardItem) {
                dashboardItem.classList.remove("d-none");
            }
            if (userName) {
                userName.textContent = userData.username;
                console.log("Welcome to Miku Sports Charity Platform,", userData.username);
            }
            if (userAvatar) {
                userAvatar.src = userData.avatarUrl || "../public/images/avatar.png";
                userAvatar.classList.remove("d-none");
                userAvatar.style.display = "block";
            }
            if (loginBtn) loginBtn.style.display = "none";
        } else {
            if (publicCheckbox) {
                console.log("Public checkbox is visible");
                publicCheckbox.classList.add("d-none");
            }
            if (loginBtn) loginBtn.style.display = "block";
            if (userAvatar) userAvatar.style.display = "none";
        }
    }

    function logout() {
        fetch("../public/api/logout", {
            method: "POST",
            credentials: "include",
        }).then(() => {
            localStorage.removeItem("previousPage");
            updateUI();
        });
    }

    logoutButtons.forEach(function (logoutBtn) {
        logoutBtn.addEventListener("click", function () {
            logout();
        });
    });

    async function redirectIfNotLoggedIn() {
        const userData = await verifyLogin();
        if (!userData) {
            console.log("User is not logged in, redirecting to login page");
            if (loginOverlay) {
                loginOverlay.style.display = "flex"; 
                document.body.style.pointerEvents = "none";
            }

            localStorage.setItem("previousPage", window.location.href);

            setTimeout(() => {
                window.location.href = "../public/login";
            }, 3000);
        }
    }

    if (window.location.pathname.endsWith("/volunteer")) {
        redirectIfNotLoggedIn();
    }

    updateUI();
});
