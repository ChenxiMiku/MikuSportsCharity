document.addEventListener('DOMContentLoaded', function () {
    const anonymousRadio = document.getElementById('donation-anonymous-checkbox');
    const publicRadio = document.getElementById('donation-publicly');
    const nameInput = document.getElementById('donation-name');
    const emailInput = document.getElementById('donation-email');
    const donationInfo = document.getElementById('donationInfo');

    function toggleDonationInfo() {
        if (anonymousRadio.checked) {
            nameInput.disabled = true;
            emailInput.disabled = true;
            donationInfo.classList.add('d-none');
        } else if (publicRadio.checked) {
            nameInput.disabled = false;
            emailInput.disabled = false;
            donationInfo.classList.remove('d-none');
        }
    }

    async function fetchUserDetails() {
        try {
            const response = await fetch('../public/api/getUserDetails', {
                method: 'GET',
                credentials: 'include',
            });
            const data = await response.json();
            return data.success ? data : null;
        } catch (error) {
            console.error('Error verifying token:', error);
            return null;
        }
    }
    async function fillForm() {
        const userData = await fetchUserDetails();
        if (userData) {
            nameInput.value = userData.user.name;
            emailInput.value = userData.user.email;
        }
    }

    anonymousRadio.addEventListener('change', toggleDonationInfo);
    publicRadio.addEventListener('change', toggleDonationInfo);

    if(nameInput && emailInput) {
        fillForm();
    }
    
    toggleDonationInfo();
});
