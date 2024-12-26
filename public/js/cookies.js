document.addEventListener("DOMContentLoaded", function() {
    const cookieBanner = document.getElementById("cookie-banner");
    const acceptBtn = document.getElementById("accept-cookies");

    if (!localStorage.getItem("cookiesAccepted")) {
        cookieBanner.style.display = "flex"; 
        if(document.getElementById("SigninBtn")){
            document.getElementById("SigninBtn").disabled = true;
            document.getElementById("googleSignIn").disabled = true;
            document.getElementById("githubSignIn").disabled = true;
        }
    }

    acceptBtn.addEventListener("click", function() {
        localStorage.setItem("cookiesAccepted", "true");
        if(document.getElementById("SigninBtn")){
            document.getElementById("SigninBtn").disabled = false;
            document.getElementById("googleSignIn").disabled = false;
            document.getElementById("githubSignIn").disabled = false;
        }

        cookieBanner.style.display = "none";
    });

    document.getElementById("reject-cookies").addEventListener("click", function() {
        alert("This website uses cookies to store your login status. Refusing cookies will prevent you from logging in or accessing personalized features.");
    });
  
});