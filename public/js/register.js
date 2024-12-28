document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerForm");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const SignupBtn = document.getElementById("SignupBtn");

    const feedback = {
        username: document.getElementById("usernameFeedback"),
        email: document.getElementById("emailFeedback"),
        passwordStrength: document.getElementById("passwordStrengthFeedback"),
        confirmPassword: document.getElementById("confirmPasswordFeedback"),
        form: document.getElementById("registerFeedback"), 
    };

    const passwordStrength = document.getElementById("password-strength");

    function validateUsername() {
        const value = username.value.trim();
        if (value.length < 4 || value.length > 20) {
            if(value.length !== 0) feedback.username.textContent = "Username must be between 4 and 20 characters.";
            return false;
        }
        feedback.username.textContent = "\u00A0";
        return true;
    }

    function validateEmail() {
        const value = email.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            feedback.email.textContent = "Please enter a valid email address.";
            return false;
        }
        feedback.email.textContent = "\u00A0";
        return true;
    }

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
        if (confirmPassword.value !== password.value && confirmPassword.value !== "") {
            feedback.confirmPassword.textContent = "Passwords do not match.";
            return false;
        }
        feedback.confirmPassword.textContent = "\u00A0";
        if(confirmPassword.value === "") return false;
        return true;
    }

    function clearFeedback(input) {
        if (feedback[input.id] && feedback[input.id] !== passwordStrength) {
            feedback[input.id].textContent = "\u00A0";
        }
    }
    
    function updateRegisterButtonState() {
        const isFormValid =
            validateUsername() &&
            validateEmail() &&
            validatePasswordStrength(password.value) &&
            validateConfirmPassword();
        SignupBtn.disabled = !isFormValid;
    }
    
    // Add event listeners to form fields
    [username, email, password, confirmPassword].forEach(input => {
        input.addEventListener("focus", () => clearFeedback(input));
        input.addEventListener("blur", () => {
            switch (input) {
                case username:
                    validateUsername();
                    break;
                case email:
                    validateEmail();
                    break;
                case password:
                    validatePasswordStrength(password.value);
                    break;
                case confirmPassword:
                    validateConfirmPassword();
                    break;
            }
            updateRegisterButtonState();
        });
    
        // Update button state on input change
        input.addEventListener("input", updateRegisterButtonState);
    });
  
    password.addEventListener("input", () => {
        validatePasswordStrength(password.value);
        updateRegisterButtonState();
    });

    form.addEventListener("submit", async (event) => {
        event.preventDefault(); // Prevent the default form submission

        if (!(validateUsername() && validateEmail() && validatePasswordStrength(password.value) && validateConfirmPassword())) {
            return;
        }

        const formData = {
            username: username.value.trim(),
            email: email.value.trim(),
            password: password.value.trim(),
        };

        try {
            const response = await fetch("../public/api/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
            });

            const data = await response.json();

            if (data.success) {
                feedback.form.textContent = "Registration successful! Redirecting...";
                feedback.form.classList.remove("alert-danger");
                feedback.form.classList.add("alert-success");
                feedback.form.classList.remove("d-none");
                feedback.form.classList.remove("text-danger");
                feedback.form.classList.add("text-success");
                setTimeout(() => {
                    window.location.href = data.redirect || "../public/login";
                }, 2000);
            } else {
                feedback.form.textContent = data.message || "An unexpected error occurred during registration.";
                feedback.form.classList.remove("d-none");
                feedback.form.classList.remove("text-success");
                feedback.form.classList.add("text-danger");
            }
        } catch (error) {
            feedback.form.textContent = "An unexpected error occurred. Please try again.";
            feedback.form.classList.remove("d-none");
            feedback.form.classList.remove("text-success");
            feedback.form.classList.add("text-danger");
            console.error("Registration error:", error);
        }
    });
});
