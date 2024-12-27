document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.getElementById("editButton");
    const saveButton = document.getElementById("saveButton");
    const cancelButton = document.getElementById("cancelButton");
    const editForm = document.getElementById("editForm");
    const informationSection = document.getElementById("informationSection");

    const avatarInput = document.getElementById("avatarInput");
    const userAvatar1 = document.getElementById("userAvatar1");
    const changeAvatarOverlay = document.querySelector(".change-avatar-overlay");

    const countryCodeSelect = document.getElementById("countryCode");
    const phoneInput = document.getElementById("editPhone");
    const phoneHint = document.getElementById("phoneHint");

    editButton.addEventListener("click", () => {
        editForm.classList.remove("d-none");
        informationSection.classList.add("d-none");

        document.getElementById("editName").value = document.getElementById("name").textContent.trim();
        document.getElementById("editEmail").value = document.getElementById("email").textContent.trim();

        const fullPhoneNumber = document.getElementById("phone").textContent.trim();
        const countryCodeMatch = fullPhoneNumber.match(/^\+(\d+)/);
        if (countryCodeMatch) {
            const countryCode = `+${countryCodeMatch[1]}`;
            const phoneNumber = fullPhoneNumber.replace(countryCode, "").trim();

            countryCodeSelect.value = countryCode;
            phoneInput.value = phoneNumber;
            updatePhoneValidation();
        }
    });

    saveButton.addEventListener("click", async (e) => {
        e.preventDefault();

        const updatedName = document.getElementById("editName").value.trim();
        const updatedEmail = document.getElementById("editEmail").value.trim();
        const updatedPhone = phoneInput.value.trim();
        const countryCode = countryCodeSelect.value;

        const selectedOption = countryCodeSelect.selectedOptions[0];
        const pattern = new RegExp(selectedOption.dataset.pattern);

        if (!updatedName || !updatedEmail || !updatedPhone) {
            alert("All fields are required!");
            return;
        }

        if (!pattern.test(updatedPhone)) {
            alert(`Invalid phone number format for ${selectedOption.textContent}.`);
            phoneInput.focus();
            return;
        }

        const fullPhoneNumber = `${countryCode} ${updatedPhone}`;

        try {
            const response = await fetch('../public/api/updateProfile', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    name: updatedName,
                    email: updatedEmail,
                    phone: fullPhoneNumber,
                }),
            });
            const data = await response.json();

            if (data.success) {
                document.getElementById("name").textContent = updatedName;
                document.getElementById("email").textContent = updatedEmail;
                document.getElementById("phone").textContent = fullPhoneNumber;
                alert("Information updated successfully!");
            } else {
                alert(data.message || "Failed to update information.");
            }
        } catch (error) {
            console.error("Error updating profile:", error);
            alert("An error occurred while updating the profile.");
        }

        editForm.classList.add("d-none");
        informationSection.classList.remove("d-none");
    });

    cancelButton.addEventListener("click", (e) => {
        e.preventDefault();
        editForm.classList.add("d-none");
        informationSection.classList.remove("d-none");
    });

    const updatePhoneValidation = () => {
        const selectedOption = countryCodeSelect.selectedOptions[0];

        if (!selectedOption) {
            console.error("No country code option selected.");
            phoneHint.textContent = "Please select a country code.";
            phoneHint.classList.add("text-danger");
            return;
        }

        const pattern = selectedOption.dataset.pattern
            ? new RegExp(selectedOption.dataset.pattern)
            : null;

        if (!pattern) {
            console.error("No validation pattern found for selected country code.");
            phoneHint.textContent = "Invalid country code configuration.";
            phoneHint.classList.add("text-danger");
            return;
        }

        const maxLength = pattern.toString().match(/\d+/)[0]; 
        phoneInput.setAttribute("maxlength", maxLength);

        phoneInput.addEventListener("input", () => {
            if (!pattern.test(phoneInput.value)) {
                phoneHint.textContent = `Invalid phone number for ${selectedOption.textContent}`;
                phoneHint.classList.add("text-danger");
                phoneHint.classList.remove("text-success");
            } else {
                phoneHint.textContent = "Phone number looks good.";
                phoneHint.classList.add("text-success");
                phoneHint.classList.remove("text-danger");
            }
        });
    };

    countryCodeSelect.addEventListener("change", updatePhoneValidation);

    changeAvatarOverlay.addEventListener("click", () => {
        avatarInput.click();
    });

    avatarInput.addEventListener("change", async () => {
        const file = avatarInput.files[0];
        if (!file) {
            alert("No file selected.");
            return;
        }

        const formData = new FormData();
        formData.append("avatar", file);

        try {
            const response = await fetch('../public/api/changeAvatar', {
                method: 'POST',
                body: formData,
            });
            const data = await response.json();

            if (data.success) {
                userAvatar1.src = data.avatarPath;
                alert("Avatar updated successfully!");
            } else {
                alert(data.message || "Failed to update avatar.");
            }
        } catch (error) {
            console.error("Error uploading avatar:", error);
            alert("An error occurred while uploading the avatar.");
        }
    });
});
