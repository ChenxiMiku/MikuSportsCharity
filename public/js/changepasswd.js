document.addEventListener('DOMContentLoaded', function () {
    const oldPasswordInput = document.getElementById('oldPasswd');
    const newPasswordInput = document.getElementById('newPasswd');
    const confirmPasswordInput = document.getElementById('confirmPasswd');
    const confirmButton = document.getElementById('confirmButton');

    function validatePassword(password) {
        const minLength = 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasDigit = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        
        return password.length >= minLength && hasUppercase && hasLowercase && hasDigit && hasSpecialChar;
    }

    function validateForm() {
        const oldPassword = oldPasswordInput.value.trim();
        const newPassword = newPasswordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();

        if (!oldPassword) {
            alert("Please enter your old password.");
            return false;
        }

        if (!validatePassword(newPassword)) {
            alert("Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.");
            return false;
        }

        if (newPassword !== confirmPassword) {
            alert("The new password and confirmation password do not match.");
            return false;
        }

        return true;
    }

    confirmButton.addEventListener('click', function (event) {
        event.preventDefault(); 

        if (validateForm()) {
            alert('Password changed successfully!');
        }
    });
});
