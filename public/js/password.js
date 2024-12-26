document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm-password");
    const progressBar = document.getElementById("password-strength");
    const strengthText = document.getElementById("password-strength-text");
    const registerButton = document.getElementById("registerBtn");
    const passwordMatchText = document.getElementById("password-match-text");

    function evaluatePasswordStrength(password) {
        let strength = 0;

        // Evaluate password strength
        if (/[A-Z]/.test(password)) strength++; 
        if (/[a-z]/.test(password)) strength++; 
        if (/\d/.test(password)) strength++; 
        if (/[!@#$%^&*(),_?":{}|<>]/.test(password)) strength++; 
        return strength;
    }

    function updateStrengthIndicator(strength, password) {
        if (password.length < 8) {
            progressBar.style.width = "0%";
            progressBar.setAttribute("aria-valuenow", 0);
            progressBar.className = "progress-bar-passwd weak";
            strengthText.textContent = "Password must be at least 8 characters long";
            return false;
        }

        let width = ((strength-1) / 3) * 100; 
        progressBar.style.width = `${width}%`;
        progressBar.setAttribute("aria-valuenow", width);

        if (strength <= 2) {
            progressBar.className = "progress-bar-passwd weak";
            strengthText.textContent = "Password strength: Weak";
            return false;
        } else if (strength === 3) {
            progressBar.className = "progress-bar-passwd medium";
            strengthText.textContent = "Password strength: Medium";
            return true;
        } else if (strength === 4) {
            progressBar.className = "progress-bar-passwd strong";
            strengthText.textContent = "Password strength: Strong";
            return true;
        }
    }

    function validatePasswordsMatch(password, confirmPassword) {
        if (password !== confirmPassword) {
            return false;
        } else {
            return true;
        }
    }

    function checkFormValidity() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const strength = evaluatePasswordStrength(password);
        const isPasswordStrong = updateStrengthIndicator(strength, password);
        const isPasswordMatching = validatePasswordsMatch(password, confirmPassword);

        registerButton.disabled = !(isPasswordStrong && isPasswordMatching);
    }

    passwordInput.addEventListener("input", checkFormValidity);
    confirmPasswordInput.addEventListener("input", checkFormValidity);
});
