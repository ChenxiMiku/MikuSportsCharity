document.addEventListener("DOMContentLoaded", function() {
    const loginButton = document.getElementById("SigninBtn");
    const googleButton = document.getElementById("googleSignIn");
    const githubButton = document.getElementById("githubSignIn");
    const loginForm = document.getElementById("loginForm");

    function setLoginCookie() {
        const expires = new Date();
        expires.setDate(expires.getDate() + 7); // Cookie 有效期 7 天
        document.cookie = `isLoggedIn=true; expires=${expires.toUTCString()}; path=/;`;
    }

    if (loginButton) {
        loginButton.addEventListener("click", function(event) {
            event.preventDefault(); // 防止表单默认提交

            // 如果表单有效，才继续执行登录逻辑
            if (loginForm.checkValidity()) {
                setLoginCookie();
                // 登录成功后重定向到原来的页面
                const previousPage = localStorage.getItem('previousPage');
                window.location.href = previousPage ? previousPage : "dashboard.html";
            } else {
                // 如果验证失败，可以显示错误提示
                loginForm.reportValidity();
            }
        });
    }

    if (googleButton) {
        googleButton.addEventListener("click", function(event) {
            event.preventDefault();

            // Add Google login logic here
            setLoginCookie();
            
            // 登录成功后重定向到原来的页面
            const previousPage = localStorage.getItem('previousPage');
            window.location.href = previousPage ? previousPage : "dashboard.html";
        });
    }

    if (githubButton) {
        githubButton.addEventListener("click", function(event) {
            event.preventDefault();

            // 这里可以添加 GitHub 登录逻辑
            setLoginCookie();

            // 登录成功后重定向到原来的页面
            const previousPage = localStorage.getItem('previousPage');
            window.location.href = previousPage ? previousPage : "dashboard.html";
        });
    }
});
