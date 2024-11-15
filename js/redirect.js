document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("loginOverlay").style.display = "none";  

    function isLoggedIn() {
        const cookies = document.cookie.split("; ");
        for (let cookie of cookies) {
            if (cookie.startsWith("isLoggedIn=true")) {
                return true;  
            }
        }
        return false;  
    }

    if (!isLoggedIn()) {
        document.getElementById("loginOverlay").style.display = "flex";  
        document.body.style.pointerEvents = "none";  
        localStorage.setItem('previousPage', window.location.href);

        setTimeout(function() {
            window.location.href = "login.html";  
        }, 3000);  
    }
});
