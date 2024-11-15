// Define the variables globally so they can be accessed in any function
let eventSection, formSection, submittedSection, nextButton, previousButton;

document.addEventListener("DOMContentLoaded", function() {
    // Initialize the variables after DOM is fully loaded
    eventSection = document.getElementById("event-section");
    formSection = document.getElementById("form-section");
    submittedSection = document.getElementById("submitted-section");
    nextButton = document.getElementById("nextBtn");
    previousButton = document.getElementById("previousBtn");

    eventSection.classList.add("active");
    formSection.style.display = "none"; 
    submittedSection.style.display = "none"; 

    nextButton.addEventListener("click", handleNextButtonClick);
    previousButton.addEventListener("click", handlePreviousButtonClick);

    const divs = document.querySelectorAll('[id^="eventDiv"]');
    divs.forEach(div => {
        div.addEventListener('click', toggleCheckbox);
    });

    const volunteerForm = document.getElementById("volunteerForm");
    volunteerForm.addEventListener("submit", handleSubmit);
});

// Store event times for each event
const eventTimes = {
    event1: [
        { start: "08:00", end: "12:00" },
        { start: "13:00", end: "17:00" }
    ],
    event2: [
        { start: "09:00", end: "13:00" },
        { start: "14:00", end: "18:00" }
    ],
    event3: [
        { start: "10:00", end: "14:00" },
        { start: "15:00", end: "19:00" }
    ]
};

// Toggle checkbox when clicking on event div (without clicking the checkbox itself)
function toggleCheckbox(event) {
    const divId = event.currentTarget.id;
    const checkboxId = divId.replace("eventDiv", "event");
    const checkbox = document.getElementById(checkboxId);

    if (event.target.tagName !== 'INPUT' && event.target.tagName !== 'LABEL' && checkbox) {
        checkbox.checked = !checkbox.checked;
    }

    updateNextButtonStatus();
    updateSelectedEvents();
}

// Update the status of the Next button based on selected checkboxes
function updateNextButtonStatus() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let isChecked = false;

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            isChecked = true;
        }
    });

    const nextButton = document.getElementById("nextBtn");
    nextButton.disabled = !isChecked; 
}

// Handle the "Next" button click (transition to the next section)
function handleNextButtonClick() {
    eventSection.classList.remove("active");
    eventSection.classList.add("slide-out-left");
    formSection.style.display = "block";
    formSection.classList.add("slide-in-right");

    setTimeout(() => {
        eventSection.style.display = "none";
        formSection.classList.remove("slide-in-right");
        eventSection.classList.add("slide-out-left");
        formSection.classList.add("active");

        document.documentElement.scrollTop = 0;
    }, 500);
}

// Handle the "Previous" button click (transition back to the event section)
function handlePreviousButtonClick() {
    formSection.classList.remove("active");
    formSection.classList.add("slide-out-right");
    eventSection.style.display = "block";
    eventSection.classList.add("slide-in-left");

    setTimeout(() => {
        formSection.style.display = "none";
        eventSection.classList.remove("slide-in-left");
        formSection.classList.add("slide-out-right");
        eventSection.classList.add("active");

        document.documentElement.scrollTop = 0;
    }, 500);
}

// Dynamically update selected events and their time slots in the second step
function updateSelectedEvents() {
    const selectedEventsContainer = document.getElementById("selected-events");
    selectedEventsContainer.innerHTML = "";

    let selectedEvents = [];

    if (document.getElementById("event1").checked) {
        selectedEvents.push("event1");
    }
    if (document.getElementById("event2").checked) {
        selectedEvents.push("event2");
    }
    if (document.getElementById("event3").checked) {
        selectedEvents.push("event3");
    }

    selectedEvents.forEach(eventId => {
        let eventContainer = document.createElement('div');
        eventContainer.classList.add('selected-event');

        let times = eventTimes[eventId];
        let eventName = document.querySelector(`#${eventId}`).closest('.event-block').querySelector('h5').textContent;

        let eventTitle = document.createElement('h5');
        eventTitle.textContent = eventName;
        eventContainer.appendChild(eventTitle);

        let timeSelect = document.createElement('select');
        timeSelect.name = `${eventId}_time`;
        timeSelect.classList.add("form-control");

        times.forEach(time => {
            let option = document.createElement('option');
            option.value = `${time.start} - ${time.end}`;
            option.textContent = `${time.start} - ${time.end}`;
            timeSelect.appendChild(option);
        });

        eventContainer.appendChild(timeSelect);
        selectedEventsContainer.appendChild(eventContainer);
    });
}

// Handle the form submission
function handleSubmit(event) {
    event.preventDefault();

    // Get form data
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const selectedEvents = getSelectedEventTimes();

    // Display the submitted information
    const submittedDetails = document.getElementById("submitted-details");
    submittedDetails.innerHTML = `
        <h3>Registration Summary</h3>
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Phone:</strong> ${phone}</p>
        <p><strong>Selected Events:</strong></p>
        <ul>
            ${selectedEvents.map(event => `
                <li>${event.name} - ${event.time}</li>
            `).join('')}
        </ul>
    `;

    // Slide out form section and show submitted section with slide-in animation
    formSection.classList.add("slide-out-left");
    formSection.classList.remove("active");

    submittedSection.style.display = "block";
    submittedSection.classList.add("slide-in-right");

    setTimeout(() => {
        formSection.style.display = "none";
        formSection.classList.remove("slide-out-left");
        submittedSection.classList.remove("slide-in-right");
        submittedSection.classList.add("active");

        document.documentElement.scrollTop = 0;
    }, 500);
}

// Get the selected event times from the form
function getSelectedEventTimes() {
    const selectedEvents = [];

    if (document.getElementById("event1").checked) {
        const time = document.querySelector('[name="event1_time"]').value;
        selectedEvents.push({ name: "Volunteer for Running Race", time });
    }
    if (document.getElementById("event2").checked) {
        const time = document.querySelector('[name="event2_time"]').value;
        selectedEvents.push({ name: "Volunteer for Basketball Tournament", time });
    }
    if (document.getElementById("event3").checked) {
        const time = document.querySelector('[name="event3_time"]').value;
        selectedEvents.push({ name: "Volunteer for Football Match", time });
    }

    return selectedEvents;
}
