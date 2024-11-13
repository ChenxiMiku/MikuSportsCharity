document.addEventListener("DOMContentLoaded", function() {
    const loginButton = document.getElementById("SigninBtn");
    const googleButton = document.getElementById("googleSignIn");
    const githubButton = document.getElementById("githubSignIn");

    // 定义一个函数来设置 cookie，保存登录状态
    function setLoginCookie() {
        const expires = new Date();
        expires.setDate(expires.getDate() + 7); // Cookie 有效期 7 天
        document.cookie = `isLoggedIn=true; expires=${expires.toUTCString()}; path=/;`;
    }

    if (loginButton) {
        loginButton.addEventListener("click", function(event) {
            event.preventDefault(); // 防止表单默认提交

            // 在这里添加登录验证逻辑，验证成功后设置 cookie
            setLoginCookie();
            
            // 验证成功后重定向到 user.html
            window.location.href = "dashboard.html";
        });
    }

    if (googleButton) {
        googleButton.addEventListener("click", function(event) {
            event.preventDefault();

            // 这里可以添加 Google 登录逻辑
            setLoginCookie();
            
            // 成功后重定向到 user.html
            window.location.href = "user.html";
        });
    }

    if (githubButton) {
        githubButton.addEventListener("click", function(event) {
            event.preventDefault();

            // 这里可以添加 GitHub 登录逻辑
            setLoginCookie();

            // 成功后重定向到 user.html
            window.location.href = "user.html";
        });
    }
});
