document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    function setLoginCookie() {
        const expires = new Date();
        expires.setDate(expires.getDate() + 7);
        document.cookie = `isLoggedIn=true; expires=${expires.toUTCString()}; path=/;`;
    }

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault(); 

        const submitButton = event.submitter; 

        if (submitButton.id === "SigninBtn") {

            const formData = new FormData(loginForm);

            fetch("common/login_handler.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        setLoginCookie();
                        const previousPage = localStorage.getItem("previousPage");
                        window.location.href = previousPage ? previousPage : data.redirect;
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An error occurred. Please try again.");
                });
        } else if (submitButton.id === "googleSignIn") {
            // Google 登录逻辑（可替换为真实的 Google 登录 API）
            alert("Google login not implemented yet.");
            setLoginCookie();
            window.location.href = "dashboard.php";
        } else if (submitButton.id === "githubSignIn") {
            // GitHub 登录逻辑（可替换为真实的 GitHub 登录 API）
            alert("GitHub login not implemented yet.");
            setLoginCookie();
            window.location.href = "dashboard.php";
        }
    });
});
