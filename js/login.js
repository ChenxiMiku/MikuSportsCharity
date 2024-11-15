document.addEventListener("DOMContentLoaded", function() {
    const loginButton = document.getElementById("SigninBtn");
    const googleButton = document.getElementById("googleSignIn");
    const githubButton = document.getElementById("githubSignIn");
    const loginForm = document.getElementById("loginForm");

    function setLoginCookie() {
        const expires = new Date();
        expires.setDate(expires.getDate() + 7);
        document.cookie = `isLoggedIn=true; expires=${expires.toUTCString()}; path=/;`;
    }

    if (loginButton) {
        loginButton.addEventListener("click", function(event) {
            event.preventDefault(); 


            if (loginForm.checkValidity()) {
                setLoginCookie();

                const previousPage = localStorage.getItem('previousPage');
                window.location.href = previousPage ? previousPage : "dashboard.html";
            } else {

                loginForm.reportValidity();
            }
        });
    }

    if (googleButton) {
        googleButton.addEventListener("click", function(event) {
            event.preventDefault();

            // Add Google login logic here
            setLoginCookie();
            

            const previousPage = localStorage.getItem('previousPage');
            window.location.href = previousPage ? previousPage : "dashboard.html";
        });
    }

    if (githubButton) {
        githubButton.addEventListener("click", function(event) {
            event.preventDefault();


            setLoginCookie();


            const previousPage = localStorage.getItem('previousPage');
            window.location.href = previousPage ? previousPage : "dashboard.html";
        });
    }
});
