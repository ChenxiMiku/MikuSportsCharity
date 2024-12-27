document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("changePasswordForm");
    const oldPassword = document.getElementById("oldPasswd");
    const newPassword = document.getElementById("newPasswd");
    const confirmPassword = document.getElementById("confirmPasswd");
    const confirmButton = document.getElementById("confirmButton");

    const feedback = {
        passwordStrength: document.getElementById("passwordStrengthFeedback"),
        confirmPassword: document.getElementById("confirmPasswordFeedback"),
        form: document.getElementById("changePasswordFeedback"), 
    };

    const passwordStrength = document.getElementById("password-strength");

    function validatePasswordStrength(value) {
        let strength = 0;
        if(value.length < 8) {
            passwordStrength.style.width = "0%";
            passwordStrength.className = "progress-bar bg-danger";
            feedback.passwordStrength.textContent = "Password must be at least 8 characters long.";
            return false;
        }
        if(/[a-z]/.test(value)) strength += 25;
        if (/[A-Z]/.test(value)) strength += 25;
        if (/[0-9]/.test(value)) strength += 25;
        if (/[\W_]/.test(value)) strength += 25;
        passwordStrength.style.width = `${strength}%`;
        passwordStrength.className = `progress-bar ${strength >= 75 ? 'bg-success' : strength >= 50 ? 'bg-warning' : 'bg-danger'}`;
        feedback.passwordStrength.textContent = `Password strength: ${strength >= 75 ? 'Strong' : strength >= 50 ? 'Medium' : 'Weak'}`;
        return strength >= 50;
    }

    function validateConfirmPassword() {
        if (confirmPassword.value !== newPassword.value && confirmPassword.value !== "") {
            feedback.confirmPassword.textContent = "Passwords do not match.";
            return false;
        }
        feedback.confirmPassword.textContent = "\u00A0";
        return true;
    }

    function clearFeedback(input) {
        if (feedback[input.id]) {
            feedback[input.id].textContent = "\u00A0";
        }
    }

    function updateChangePasswordButtonState() {
        const isFormValid = validatePasswordStrength(newPassword.value) && validateConfirmPassword();
        confirmButton.disabled = !isFormValid;
    }

    [newPassword, confirmPassword].forEach(input => {
        input.addEventListener("focus", () => clearFeedback(input));
        input.addEventListener("blur", () => {
            if (input === confirmPassword) validateConfirmPassword();
            updateChangePasswordButtonState();
        });
    });

    newPassword.addEventListener("input", () => {
        validatePasswordStrength(newPassword.value);
        updateChangePasswordButtonState();
    });

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        if (!(validatePasswordStrength(newPassword.value) && validateConfirmPassword())) {
            return;
        }

        const formData = {
            oldPassword: oldPassword.value.trim(),
            newPassword: newPassword.value.trim(),
        };

        try {
            console.log(formData);
            const response = await fetch("../public/api/changePassword", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
            });

            const data = await response.json();

            if (data.success) {
                feedback.form.textContent = "Password changed successfully!";
                feedback.form.classList.remove("alert-danger");
                feedback.form.classList.add("alert-success");
                feedback.form.classList.remove("d-none");
            } else {
                feedback.form.textContent = data.message || "An unexpected error occurred.";
                feedback.form.classList.remove("d-none");
                feedback.form.classList.add("alert-danger");
            }
        } catch (error) {
            feedback.form.textContent = "An unexpected error occurred. Please try again.";
            feedback.form.classList.remove("d-none");
            feedback.form.classList.add("alert-danger");
            console.error("Change password error:", error);
        }
    });
});
