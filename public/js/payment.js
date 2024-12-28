document.addEventListener("DOMContentLoaded", function () {
    const donationForm = document.querySelector(".donate-form");
    const publicRadio = document.getElementById("donation-publicly");
    const nameInput = document.getElementById("donation-name");
    const emailInput = document.getElementById("donation-email");

    donationForm.addEventListener("submit", async function (event) {
        event.preventDefault(); 

        const amount = document.querySelector('input[name="flexRadioDefault"]:checked')?.nextElementSibling?.textContent.trim().replace('$', '') || 
            document.querySelector(".input-group input").value.trim();

        if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
            alert("Please select or enter a valid donation amount.");
            return;
        }

        const donationChoice = publicRadio.checked ? "public" : "anonymous";
        const name = donationChoice === "public" ? nameInput.value.trim() : "anonymous";
        const email = donationChoice === "public" ? emailInput.value.trim() : "none";
        const paymentMethod = document.querySelector('input[name="DonationPayment"]:checked')?.id;

        if (!paymentMethod) {
            alert("Please select a payment method.");
            return;
        }

        const eventName = document.getElementById("event-name").textContent.trim();
        const charityName = document.getElementById("charity-name").textContent.trim();

        let anonymous = 0;

        if(donationChoice === "anonymous" && confirm("Are you sure you want to donate anonymously?")) {
            anonymous = 1;
        } else if(donationChoice === "anonymous") {
            return;
        }

        const donationData = {
            amount: parseFloat(amount),
            choice: donationChoice,
            name,
            email,
            paymentMethod,
            eventName,
            charityName,
            anonymous,
        };

        try {
            console.log("Donation data:", donationData);
            const response = await fetch("../public/api/pay", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(donationData),
            });

            const html = await response.text();
            const tempDiv = document.createElement("div");
            tempDiv.innerHTML = html;
            const form = tempDiv.querySelector("form");

            if (form) {
                document.body.appendChild(form); 
                form.submit(); 
            } else {
                alert("Unexpected response from the server. Please try again.");
            }
        } catch (error) {
            console.error("Error processing payment:", error);
            alert("An unexpected error occurred. Please try again later.");
        }
    });
});
