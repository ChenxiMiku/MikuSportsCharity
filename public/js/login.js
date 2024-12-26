document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");
    const loginError = document.getElementById("loginError");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    function hideErrorMessage() {
        loginError.textContent = "";
        loginError.classList.add("d-none");
    }

    usernameInput.addEventListener("input", hideErrorMessage);
    passwordInput.addEventListener("input", hideErrorMessage);

    loginForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formData = new FormData(loginForm);
        const username = formData.get("username");
        const password = formData.get("password");

        try {
            const response = await fetch("../public/api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ username, password })
            });

            const data = await response.json();
            console.log(data);

            if (response.ok && data.success) {
                console.log(localStorage.getItem("previousPage"));
                if (localStorage.getItem("previousPage")) {
                    console.log("Redirecting to previous page...");
                    window.location.href = localStorage.getItem("previousPage");
                    localStorage.removeItem("previousPage");
                }
                else{
                    window.location.href = "../public/dashboard";
                }
            } else {
                loginError.textContent = data.message || "Invalid username or password.";
                loginError.classList.remove("d-none");
            }
        } catch (error) {
            loginError.textContent = "An error occurred. Please try again.";
            loginError.classList.remove("d-none");
        }
    });
});
