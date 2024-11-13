document.addEventListener("DOMContentLoaded", function() {
    const cookieBanner = document.getElementById("cookie-banner");
    const acceptBtn = document.getElementById("accept-cookies");
    // 检查用户是否已经接受了 cookies
    if (!localStorage.getItem("cookiesAccepted")) {
        cookieBanner.style.display = "flex";  // 显示 cookie 同意框
        if(document.getElementById("SigninBtn")){
            document.getElementById("SigninBtn").disabled = true;
            document.getElementById("googleSignIn").disabled = true;
            document.getElementById("githubSignIn").disabled = true;
        }
    }
    // 点击“接受所有 cookies”按钮后
    acceptBtn.addEventListener("click", function() {
        // 用户接受 cookies
        localStorage.setItem("cookiesAccepted", "true");
        if(document.getElementById("SigninBtn")){
            document.getElementById("SigninBtn").disabled = false;
            document.getElementById("googleSignIn").disabled = false;
            document.getElementById("githubSignIn").disabled = false;
        }
        // 隐藏 cookie 同意框
        cookieBanner.style.display = "none";
    });

    document.getElementById("reject-cookies").addEventListener("click", function() {
        // 拒绝 cookies 后，禁用登录功能
        alert("This website uses cookies to store your login status. Refusing cookies will prevent you from logging in or accessing personalized features.");
    });
  
});
