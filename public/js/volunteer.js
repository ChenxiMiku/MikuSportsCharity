document.addEventListener("DOMContentLoaded", async function () {
    const eventSection = document.getElementById("event-section");
    const formSection = document.getElementById("form-section");
    const submittedSection = document.getElementById("submitted-section");
    const nextButton = document.getElementById("nextBtn");
    const previousButton = document.getElementById("previousBtn");
    const volunteerForm = document.getElementById("volunteerForm");

    let eventTimes = {}; // Store event times fetched from backend

    // Fetch event times from backend
    async function fetchEventTimes() {
        try {
            const response = await fetch("../public/api/getEventsTimes", { method: "GET" });
            const data = await response.json();
            if (data.success) {
                data.events.forEach(event => {
                    eventTimes[event.event_id] = event.times;
                });
            }
        } catch (error) {
            console.error("Error fetching event times:", error);
        }
    }

    // Fetch user details from backend
    async function fetchUserDetails() {
        try {
            const response = await fetch("../public/api/getUserDetails", { method: "GET" });
            const data = await response.json();
            if (data.success) {
                document.getElementById("name").value = data.user.name || "";
                document.getElementById("email").value = data.user.email || "";

                // Split phone into country code and number
                const phone = data.user.contact_number || "";
                const phoneMatch = phone.match(/^\+?(\d{1,4})\s*(.*)$/);
                if (phoneMatch) {
                    document.getElementById("countryCode").value = `+${phoneMatch[1]}`;
                    document.getElementById("phone").value = phoneMatch[2];
                }
            }
        } catch (error) {
            console.error("Error fetching user details:", error);
        }
    }

    // Parse URL parameters
    function getUrlParams() {
        const params = {};
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        urlParams.forEach((value, key) => {
            params[key] = decodeURIComponent(value);
        });
        return params;
    }

    function autoSelectEvent() {
        const params = getUrlParams();
        if (params.event) {
            const eventCheckbox = Array.from(document.querySelectorAll('input[name="selected_events[]"]')).find(
                checkbox => checkbox.closest(".custom-block").querySelector("h5").textContent.trim() === params.event
            );
            
            if (eventCheckbox) {
                eventCheckbox.checked = true;
                updateNextButtonStatus();
                updateSelectedEvents();
            }
        }
    }

    // Submit registration details to backend
    async function submitRegistration() {
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const countryCode = document.getElementById("countryCode").value;
        const phoneNumber = document.getElementById("phone").value;

        const phone = `${countryCode.trim()} ${phoneNumber.trim()}`;

        const selectedCheckboxes = document.querySelectorAll('input[name="selected_events[]"]:checked');
        const selectedEvents = [];

        selectedCheckboxes.forEach(checkbox => {
            const eventId = checkbox.value;
            const timeSelect = document.querySelector(`[name="event${eventId}_time"]`);
            const time = timeSelect ? timeSelect.value : "";

            if (time) {
                selectedEvents.push({ event_id: eventId, time });
            }
        });

        try {
            const response = await fetch("../public/api/submitVolunteer", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ name, email, phone, selectedEvents }),
            });
            const data = await response.json();
            if (data.success) {
                return data.message;
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            console.error("Error submitting registration:", error);
            return error.message;
        }
    }

    await fetchEventTimes();
    await fetchUserDetails();

    // Initialize sections
    eventSection.classList.add("active");
    formSection.style.display = "none";
    submittedSection.style.display = "none";
    nextButton.disabled = true;

    const eventBlocks = document.querySelectorAll(".custom-block");
    eventBlocks.forEach(block => {
        block.addEventListener("click", function (event) {
            const checkbox = block.querySelector('input[type="checkbox"]');
            if (event.target.tagName !== "INPUT" && event.target.tagName !== "LABEL" && checkbox) {
                checkbox.checked = !checkbox.checked;
            }

            updateNextButtonStatus();
            updateSelectedEvents();
        });
    });

    nextButton.addEventListener("click", handleNextButtonClick);
    previousButton.addEventListener("click", handlePreviousButtonClick);

    volunteerForm.addEventListener("submit", handleSubmit);

    function updateNextButtonStatus() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        nextButton.disabled = !isChecked;
    }

    function updateSelectedEvents() {
        const selectedEventsContainer = document.getElementById("selected-events");
        selectedEventsContainer.innerHTML = ""; 
        const selectedCheckboxes = document.querySelectorAll('input[name="selected_events[]"]:checked');
        selectedCheckboxes.forEach(checkbox => {
            const block = checkbox.closest(".custom-block");
            const eventId = checkbox.value;
            const eventName = block.querySelector("h5").textContent;

            const eventContainer = document.createElement("div");
            eventContainer.classList.add("selected-event");

            const eventTitle = document.createElement("h5");
            eventTitle.textContent = eventName;
            eventContainer.appendChild(eventTitle);

            const timeSelect = document.createElement("select");
            timeSelect.name = `event${eventId}_time`;
            timeSelect.classList.add("form-control");
            const defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.textContent = "Select a time slot";
            defaultOption.disabled = true;
            defaultOption.selected = true;
            timeSelect.appendChild(defaultOption);

            if (eventTimes[eventId]) {
                eventTimes[eventId].forEach(slot => {
                    const option = document.createElement("option");
                    option.value = `${slot.start} - ${slot.end}`;
                    option.textContent = `${slot.start} - ${slot.end}`;
                    timeSelect.appendChild(option);
                });
            }

            eventContainer.appendChild(timeSelect);
            selectedEventsContainer.appendChild(eventContainer);
        });
    }

    function handleNextButtonClick() {
        eventSection.style.display = "none";
        formSection.style.display = "block";
        formSection.classList.add("active");
        document.documentElement.scrollTop = 0;
    }

    function handlePreviousButtonClick() {
        formSection.style.display = "none";
        eventSection.style.display = "block";
        eventSection.classList.add("active");
        document.documentElement.scrollTop = 0;
    }

    async function handleSubmit(event) {
        event.preventDefault();

        const selectedCheckboxes = document.querySelectorAll('input[name="selected_events[]"]:checked');
        let allTimesSelected = true;

        selectedCheckboxes.forEach(checkbox => {
            const eventId = checkbox.value;
            const timeSelect = document.querySelector(`[name="event${eventId}_time"]`);
            if (!timeSelect || !timeSelect.value) {
                allTimesSelected = false;
                timeSelect.classList.add("is-invalid");
            } else {
                timeSelect.classList.remove("is-invalid");
            }
        });

        if (!allTimesSelected) {
            alert("Please select a time slot for each selected event.");
            return;
        }

        const resultMessage = await submitRegistration();
        const summaryContainer = document.getElementById("submitted-details");
        summaryContainer.innerHTML = 
        `<h3>Submission Result</h3>
        <p>${resultMessage}</p>
        <p><strong>Name:</strong> ${document.getElementById("name").value}</p>
        <p><strong>Email:</strong> ${document.getElementById("email").value}</p>
        <p><strong>Phone:</strong> ${document.getElementById("countryCode").value} ${document.getElementById("phone").value}</p>
        <p><strong>Selected Events:</strong></p>
        <ul>
            ${Array.from(selectedCheckboxes).map(checkbox => {
                const block = checkbox.closest(".custom-block");
                const eventId = checkbox.value;
                const eventName = block.querySelector("h5").textContent;
                const timeSelect = document.querySelector(`[name="event${eventId}_time"]`);
                const time = timeSelect ? timeSelect.value : "";
                return `<li>${eventName} - ${time}</li>`;
            }).join('')}
        </ul>`;

        formSection.style.display = "none";
        submittedSection.style.display = "block";
    }

    document.addEventListener("change", function (event) {
        if (event.target.matches("select.form-control")) {
            event.target.classList.remove("is-invalid");
        }
    });

    // Auto-select event based on URL parameter
    autoSelectEvent();
});
