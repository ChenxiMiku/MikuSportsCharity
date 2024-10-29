document.addEventListener("DOMContentLoaded", function() {
    const loginButton = document.getElementById("SigninBtn");
    const googleButton = document.getElementById("googleSignIn");
    const githubButton = document.getElementById("githubSignIn");

    if (loginButton) {
        loginButton.addEventListener("click", function(event) {
            event.preventDefault(); // 防止表单默认提交
            // 在这里添加登录验证逻辑，验证成功后重定向
            window.location.href = "user.html"; // 重定向到 user.html
        });
    }

    if (googleButton) {
        googleButton.addEventListener("click", function(event) {
            event.preventDefault();
            // 这里可以添加 Google 登录逻辑
            window.location.href = "user.html"; // 成功后重定向
        });
    }

    if (githubButton) {
        githubButton.addEventListener("click", function(event) {
            event.preventDefault();
            // 这里可以添加 GitHub 登录逻辑
            window.location.href = "user.html"; // 成功后重定向
        });
    }
});
