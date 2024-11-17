document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const registerButton = document.getElementById('registerBtn');

    function validatePassword(password) {
        const minLength = 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasDigit = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        
        return password.length >= minLength && hasUppercase && hasLowercase && hasDigit && hasSpecialChar;
    }

    function validateForm() {
        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();

        // Check if username and email are provided
        if (!username) {
            alert("Please enter your username.");
            return false;
        }

        if (!email) {
            alert("Please enter your email address.");
            return false;
        }

        // Validate password strength
        if (!validatePassword(password)) {
            alert("Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.");
            return false;
        }

        // Check if passwords match
        if (password !== confirmPassword) {
            alert("The password and confirmation password do not match.");
            return false;
        }

        return true;
    }

    registerButton.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent form submission

        if (validateForm()) {
            alert('Registration successful!');
            // Submit form or proceed with registration logic
        }
    });
});
