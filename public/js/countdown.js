document.addEventListener("DOMContentLoaded", function () {
    let countdown = 3;
    const countdownElement = document.getElementById('countdown');
    const loginOverlay = document.getElementById('login-overlay');
    setInterval(() => {
        countdown--;
        if (countdown >= 1) {
            countdownElement.textContent = countdown;
        }
    }, 1000);

});