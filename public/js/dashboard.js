// Wait for the DOM to load
document.addEventListener("DOMContentLoaded", function () {
    const charityForm = document.getElementById("addCharityForm");
    const charityList = document.getElementById("charityList");

    // Generic function to update charity
    async function updateCharity(action, payload) {
        try {
            const response = await fetch("api/updateCharity", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ action, ...payload }),
            });

            if (!response.ok) {
                throw new Error("Failed to update charity.");
            }

            return await response.json();
        } catch (error) {
            console.error(error);
            alert("Error updating charity. Please try again.");
        }
    }

    // Function to create a new row for the table
    function createCharityRow(charity) {
        const newRow = document.createElement("tr");
        newRow.dataset.charityId = charity.id;
        newRow.innerHTML = `
            <td>${charity.name}</td>
            <td class="text-end">
                <button class="editBtn btn btn-primary me-3 btn-sm">Edit</button>
                <button class="deleteBtn btn btn-danger btn-sm">Delete</button>
            </td>`;
        return newRow;
    }

    // Add new charity
    charityForm.addEventListener("submit", async function (e) {
        e.preventDefault();
        const charityName = document.getElementById("charityNameInput").value.trim();

        if (!charityName) {
            alert("Please fill in the charity name.");
            return;
        }
        const result = await updateCharity("add", { name: charityName });
        if (result && result.charity) {
            charityList.appendChild(createCharityRow(result.charity));
            charityForm.reset();
            alert("Charity added successfully.");
        }
    });

    // Handle edit and delete actions
    charityList.addEventListener("click", async function (e) {
        const row = e.target.closest("tr");
        const charityId = row.dataset.id;

        if (e.target.classList.contains("editBtn")) {
            const nameCell = row.children[0];
            const newName = prompt("Edit Charity Name:", nameCell.textContent);

            if (newName) {
                const result = await updateCharity("edit", { id: charityId, name: newName });
                if (result && result.success) {
                    nameCell.textContent = newName;
                    alert("Charity updated successfully.");
                }
            }
        } else if (e.target.classList.contains("deleteBtn")) {
            if (confirm("Are you sure you want to delete this charity?")) {
                const result = await updateCharity("delete", { id: charityId });
                if (result && result.success) {
                    row.remove();
                    alert("Charity deleted successfully.");
                }
            }
        }
    });

    // Activity Management Section

    const activityType = document.getElementById("activityType");
    const donationFields = document.getElementById("donationFields");
    const volunteerFields = document.getElementById("volunteerFields");

    document.querySelectorAll('#donationFields input, #volunteerFields input').forEach(input => {
        input.removeAttribute('required');
    });

    activityType.addEventListener("change", function () {
        if (activityType.value === "donation") {
            donationFields.classList.remove("d-none");
            volunteerFields.classList.add("d-none");
            document.getElementById('fundingGoal').setAttribute('required', 'required');

        } else if (activityType.value === "volunteer") {
            donationFields.classList.add("d-none");
            volunteerFields.classList.remove("d-none");
            document.querySelectorAll('#volunteerFields input').forEach(input => {
                input.setAttribute('required', 'required');
            });
        } else {
            donationFields.classList.add("d-none");
            volunteerFields.classList.add("d-none");
            document.querySelectorAll('#donationFields input, #volunteerFields input').forEach(input => {
                input.removeAttribute('required');
            });
        }
    });

    async function updateActivity(action, payload) {
        try {
            const response = await fetch("api/updateEvent", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ action, ...payload }),
            });

            if (!response.ok) {
                throw new Error("Failed to update event.");
            }

            return await response.json();
        } catch (error) {
            console.error(error);
            alert("Error updating event. Please try again.");
        }
    }






    const activityForm = document.getElementById("publishActivityForm");
    const activityList = document.getElementById("activityList").querySelector("tbody");
    let activities = [];
    let editingIndex = null;

    async function fetchVolunteerEvents() {
        try {
            const response = await fetch("api/volunteerevents");
            const data = await response.json();
            console.log("Volunteer Events:", data);
            data.events.forEach(event => {
                event.id = event.event_id;
                event.title = event.event_name;
                event.charityName = event.charity_name;
                event.eventDate = event.event_date;
                event.eventLocation = event.event_location;
                event.volunteerGoal = event.volunteer_goal;
                delete event.event_name;
                delete event.charity_name;
            });
            return data.success ? data.events.map(event => ({ ...event, type: 'volunteer' })) : [];
        } catch (error) {
            console.error("Error fetching volunteer events:", error);
            return [];
        }
    }

    async function fetchDonations() {
        try {
            const response = await fetch("api/donations");
            const data = await response.json();
            console.log("Do", data);
            data.donations.forEach(donation => {
                donation.id = donation.donation_id;
                donation.charityName = donation.charity_name;
                donation.fundingGoal = donation.funding_goal;
                delete donation.charity_name;
                delete donation.funding_goal;
            });
            return data.success ? data.donations.map(donation => ({ ...donation, type: 'donation' })) : [];
        } catch (error) {
            console.error("Error fetching donations:", error);
            return [];
        }
    }

    function renderActivities() {
        activityList.innerHTML = "";
        activities.forEach((activity, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${activity.title}</td>
            <td>${activity.charityName}</td>
            <td>${activity.type}</td>
            <td>
                <button class="editBtn btn btn-primary btn-sm me-3" data-index="${index}">Edit</button>
                <button class="deleteBtn btn btn-danger btn-sm" data-index="${index}">Delete</button>
            </td>`;
            activityList.appendChild(row);
        });
    }

    (async function initialize() {
        const events = await fetchVolunteerEvents();
        const donations = await fetchDonations();
        activities = [...events, ...donations];
        renderActivities();
    })();

    function resetForm() {
        activityForm.reset();
        editingIndex = null;
        donationFields.classList.add("d-none");
        volunteerFields.classList.add("d-none");
        document.getElementById("activityId").value = "";
    }
    const cancelBtn = document.getElementById("cancelBtn");
    if (cancelBtn) {
        cancelBtn.addEventListener("click", function () {
            resetForm();
            alert("Activity form reset and changes canceled.");
        });
    } else {
        console.error("Cancel button not found. Ensure the ID 'cancelBtn' is correct.");
    }
    activityForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        const title = document.getElementById("activityTitle").value.trim();
        const charityName = document.getElementById("charityName").value.trim();
        const description = document.getElementById("activityDescription").value.trim();
        const type = document.getElementById("activityType").value;

        if (!title || !description || !type) {
            alert("Please fill in all required fields.");
            return;
        }

        let payload = { title, charityName, description, type };

        if (type === "donation") {
            const fundingGoal = document.getElementById("fundingGoal").value.trim();
            if (!fundingGoal) {
                alert("Please fill in all donation-specific fields.");
                return;
            }
            payload.fundingGoal = fundingGoal;
        } else if (type === "volunteer") {
            const eventDate = document.getElementById("eventDate").value.trim();
            const eventLocation = document.getElementById("eventLocation").value.trim();
            const volunteerGoal = document.getElementById("volunteerGoal").value.trim();

            if (!eventDate || !eventLocation || !volunteerGoal) {
                alert("Please fill in all volunteer-specific fields.");
                return;
            }

            const timeSlots = Array.from(document.querySelectorAll(".time-slot"));
            const slotData = [];

            for (const slot of timeSlots) {
                const [startTimeInput, endTimeInput] = slot.querySelectorAll("input");
                const startTime = startTimeInput.value.trim();
                const endTime = endTimeInput.value.trim();

                if (!startTime || !endTime) {
                    alert("Please fill in all time slots.");
                    return;
                }

                if (startTime >= endTime) {
                    alert("End Time must be later than Start Time for all time slots.");
                    return;
                }

                slotData.push({ startTime, endTime });
            }

            payload.eventDate = eventDate;
            payload.eventLocation = eventLocation;
            payload.volunteerGoal = volunteerGoal;
            payload.timeSlots = slotData;
        }

        try {
            let action = editingIndex !== null ? "update" : "create";
            if (editingIndex !== null) {
                payload.id = activities[editingIndex].id;
            }
            console.log("Payload:", payload);

            const result = await updateActivity(action, payload);

            if (result.success) {
                if (editingIndex !== null) {
                    activities[editingIndex] = payload;
                    alert("Activity updated successfully!");
                } else {
                    activities.push({ ...payload, id: result.id });
                    alert("Activity added successfully!");
                }

                renderActivities();
                resetForm();
            } else {
                alert("Failed to save activity. Please try again.");
            }
        } catch (error) {
            console.error("Error saving activity:", error);
        }
    });

    activityList.addEventListener("click", async function (e) {
        if (e.target.classList.contains("editBtn")) {
            editingIndex = e.target.dataset.index;
            const activity = activities[editingIndex];

            document.getElementById("activityTitle").value = activity.title;
            document.getElementById("charityName").value = activity.charityName;
            document.getElementById("activityDescription").value = activity.description;
            document.getElementById("activityType").value = activity.type;

            if (activity.type === "donation") {
                document.getElementById("fundingGoal").value = activity.fundingGoal;
                donationFields.classList.remove("d-none");
                volunteerFields.classList.add("d-none");
            } else if (activity.type === "volunteer") {
                document.getElementById("eventDate").value = activity.eventDate;
                document.getElementById("eventLocation").value = activity.eventLocation;
                document.getElementById("volunteerGoal").value = activity.volunteerGoal;
                donationFields.classList.add("d-none");
                volunteerFields.classList.remove("d-none");

                let timeSlots = activity.timeSlots || [];
                if (typeof timeSlots === "string") {
                    try {
                        timeSlots = JSON.parse(timeSlots);
                    } catch (error) {
                        console.error("Failed to parse timeSlots:", error);
                        timeSlots = []; 
                    }
                }

                if (!Array.isArray(timeSlots)) {
                    console.error("timeSlots is not an array after parsing:", timeSlots);
                    return; 
                }
                const timeSlotsContainer = document.getElementById("timeSlots");
                timeSlotsContainer.innerHTML = "";


                // Dynamically add time slots
                timeSlots.forEach(slot => {
                    const timeSlotDiv = document.createElement("div");
                    timeSlotDiv.classList.add("time-slot");

                    // Start Time Input
                    const startTimeLabel = document.createElement("small");
                    startTimeLabel.textContent = "Start time: " + slot.startTime.slice(0, 5);
                    startTimeLabel.classList.add("d-inline-block", "mx-2");

                    const startTimeInput = document.createElement("input");
                    startTimeInput.type = "time";
                    startTimeInput.classList.add("form-control", "d-inline-block", "w-45", "mb-3");
                    startTimeInput.name = "start_time";
                    startTimeInput.value = slot.startTime;
                    startTimeInput.required = true;

                    // End Time Input
                    const endTimeLabel = document.createElement("small");
                    endTimeLabel.textContent = "End time: " + slot.endTime.slice(0, 5);
                    endTimeLabel.classList.add("d-inline-block", "mx-2");

                    const endTimeInput = document.createElement("input");
                    endTimeInput.type = "time";
                    endTimeInput.classList.add("form-control", "d-inline-block", "w-45", "mb-3");
                    endTimeInput.name = "end_time";
                    endTimeInput.value = slot.endTime;
                    endTimeInput.required = true;

                    // Remove Button
                    const removeButton = document.createElement("button");
                    removeButton.type = "button";
                    removeButton.textContent = "Remove";
                    removeButton.classList.add("btn", "btn-danger", "btn-sm");
                    removeButton.onclick = function () {
                        removeTimeSlot(removeButton);
                    };

                    // Append elements to timeSlotDiv
                    timeSlotDiv.appendChild(startTimeLabel);
                    timeSlotDiv.appendChild(startTimeInput);
                    timeSlotDiv.appendChild(endTimeLabel);
                    timeSlotDiv.appendChild(endTimeInput);
                    timeSlotDiv.appendChild(removeButton);

                    // Append timeSlotDiv to the container
                    timeSlotsContainer.appendChild(timeSlotDiv);
                });

            }

            alert("Edit the form and save changes.");
        } else if (e.target.classList.contains("deleteBtn")) {
            const index = e.target.dataset.index;
            if (confirm("Are you sure you want to delete this activity?")) {
                activity = activities[index];
                const result = await updateActivity("delete", activity);
                if (result && result.success) {
                    activities.splice(index, 1);
                    renderActivities();
                    alert("Activity deleted successfully.");
                } else {
                    alert("Failed to delete activity. Please try again.");
                }
            }
        }
    });

    const timeSlotsContainer = document.getElementById("timeSlots");
    const addTimeSlotButton = document.getElementById("addTimeSlot");

    addTimeSlotButton.addEventListener("click", function () {
        const timeSlot = document.createElement("div");
        timeSlot.className = "time-slot";
        timeSlot.innerHTML = `
        <small class="d-inline-block mx-2">Start time</small>
        <input type="time" class="form-control d-inline-block w-45 mb-3" required>
        <small class="d-inline-block mx-2">End time</small>
        <input type="time" class="form-control d-inline-block w-45 mb-3" required>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeTimeSlot(this)">Remove</button>
    `;
        timeSlotsContainer.appendChild(timeSlot);
    });

    window.removeTimeSlot = function (button) {
        button.parentElement.remove();
    };

    const tabs = document.querySelectorAll(".nav-link");
    const tabContents = document.querySelectorAll(".tab-pane");

    tabs.forEach((tab) => {
        tab.addEventListener("click", function () {
            tabs.forEach((t) => t.classList.remove("active"));
            tabContents.forEach((content) => content.classList.remove("show", "active"));

            tab.classList.add("active");
            const target = document.querySelector(tab.dataset.bsTarget);
            target.classList.add("show", "active");
        });
    });

    const addCharityButton = document.getElementById("addCharityButton");
    const addCharityModal = document.getElementById("addCharityModal");
    const closeModalButton = document.getElementById("closeModalButton");

    addCharityButton.addEventListener("click", function () {
        addCharityModal.style.display = "block";
        addCharityModal.classList.add("show");
    });

    closeModalButton.addEventListener("click", function () {
        addCharityModal.style.display = "none";
        addCharityModal.classList.remove("show");
    });

    window.addEventListener("click", function (event) {
        if (event.target === addCharityModal) {
            addCharityModal.style.display = "none";
            addCharityModal.classList.remove("show");
        }
    });
});
