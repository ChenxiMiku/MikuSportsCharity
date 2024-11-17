let selectedTags = [];

// Get organization name from the URL query parameter
const urlParams = new URLSearchParams(window.location.search);
const selectedOrg = urlParams.get('organization'); // The selected organization from the URL

// Modify the fetchEvents function to handle filtering by organization
async function fetchEvents() {
    try {
        const response = await fetch('/api/events');
        const organizations = await response.json();
        renderCharityEvents(organizations);
    } catch (error) {
        console.error('Error fetching events:', error);
    }
}

// Sample organizations data with mission and goal
const organizations = [
    {
        charityName: "Kisckstarter Foundation",
        mission: "To empower communities through sustainable healthcare and education.",
        goal: "Provide resources and opportunities to underserved communities globally.",
        eventsData: [
            {
                title: "Charity Run 2024",
                url: "donate.html?charityName=Hope%20Foundation&eventName=Kickstart%20Hope&raisedAmount=18500&goalAmount=32000&eventImage=path_to_image.jpg",
                image: "images/hatsunemiku.JPG",
                tags: ["Running", "Volunteer"],
                date: "2024-05-01",
                author: "John Doe",
                comments: 20
            },
            {
                title: "Football 2024",
                url: "charity.html?organization=Run%20for%20Life",
                image: "images/hatsunemiku.JPG",
                tags: ["Donation", "Children"],
                date: "2024-06-01",
                author: "Jane Doe",
                comments: 15
            }
        ]
    },
    {
        charityName: "Run for Life",
        mission: "To support healthy living through sports and wellness activities.",
        goal: "Encourage participation in fitness programs across all age groups.",
        eventsData: [
            {
                title: "Toy Donation Drive",
                url: "charity.html",
                image: "images/hatsunemiku.JPG",
                tags: ["Donation", "Children"],
                date: "2024-07-15",
                author: "Alice Smith",
                comments: 30
            },
            {
                title: "Summer Camp Fundraiser",
                url: "charity.html",
                image: "images/hatsunemiku.JPG",
                tags: ["Running", "Volunteer"],
                date: "2024-08-10",
                author: "Bob Johnson",
                comments: 25
            }
        ]
    }
];

// Render events based on the selected organization
renderCharityEvents(organizations);

function filterEventsByTags(organizations) {
    if (selectedTags.length === 0) {
        renderCharityEvents(organizations);
    } else {
        const filteredEvents = organizations.map(organization => {
            const filteredData = organization.eventsData.filter(event =>
                selectedTags.every(tag => event.tags.includes(tag))
            );
            return { ...organization, eventsData: filteredData };
        });

        renderCharityEvents(filteredEvents);
    }
}

function renderCharityEvents(organizations) {
    const charityContainer = document.getElementById('charity-events-container');
    charityContainer.innerHTML = ''; 

    // Filter organizations if a specific one is selected from the URL
    const filteredOrganizations = selectedOrg ? 
        organizations.filter(org => org.charityName.toLowerCase() === selectedOrg.toLowerCase()) :
        organizations;

    // Create containers for "Donation" and "Volunteer" categories
    const donationContainer = document.createElement('div');
    donationContainer.classList.add('category-container', 'donation-container');
    donationContainer.innerHTML = `<h2>Donation Events</h2>`;
    
    const volunteerContainer = document.createElement('div');
    volunteerContainer.classList.add('category-container', 'volunteer-container');
    volunteerContainer.innerHTML = `<h2>Volunteer Events</h2>`;

    filteredOrganizations.forEach(organization => {
        const { charityName, mission, goal, eventsData } = organization;

        // Render charity header with mission and goal
        const charityHeader = document.createElement('div');
        charityHeader.classList.add('charity-header');
        charityHeader.innerHTML = `
            <a href="#" class="fs-1 fw-semibold">${charityName}</a>
            <p>Mission: ${mission} <br> Goal: ${goal}</p>
        `;
        charityContainer.appendChild(charityHeader);

        eventsData.forEach(event => {
            // Create the event card for the current event
            const eventItem = document.createElement('div');
            eventItem.classList.add('events-block', 'mt-3', 'me-3', 'mb-3', 'custom-block-wrap'); 
            eventItem.style.flex = '1 1 30%';
        
            // Determine the button label and URL based on the tags
            let buttonLabel = '';
            let buttonUrl = ''; // Variable to hold the URL
        
            if (event.tags.includes("Donation")) {
                buttonLabel = 'Donate now';
                buttonUrl = `donate.html?charityName=Hope%20Foundation&eventName=Kickstart%20Hope&raisedAmount=18500&goalAmount=32000&eventImage=images/causes/240808-olympics-supershoes-nike-se-1200p-734ca1.webp`; // Construct URL for charity
            } else if (event.tags.includes("Volunteer")) {
                buttonLabel = 'Volunteer';
                buttonUrl = `volunteer.html`; // Update Volunteer URL
            }
        
            eventItem.innerHTML = `
            <div class="custom-block">
                <div class="events-block-top">
                    <a href="${event.url}">
                        <img src="${event.image}" class="events-image img-fluid" alt="">
                    </a>
                    <div class="events-category-block">
                        ${event.tags.map(tag => `<a class="category-block-link" data-tag="${tag}">${tag}</a>`).join(', ')}
                    </div>
                </div>
                <div class="events-block-info">
                    <div class="d-flex mt-2">
                        <div class="ms-4 events-block-date">
                            <p><i class="bi-calendar4 custom-icon"></i> ${event.date}</p>
                        </div>
                    </div>
                    <div class="events-block-title mb-2 ms-4">
                        <h4><a href="${event.url}" class="events-block-title-link">${event.title}</a></h4>
                    </div>
                </div>
                <a href="${buttonUrl}" class="custom-btn btn">${buttonLabel}</a>
            </div>
            `;
        
            // Add event to the appropriate category container
            if (event.tags.includes("Donation")) {
                donationContainer.appendChild(eventItem);
            } else if (event.tags.includes("Volunteer")) {
                volunteerContainer.appendChild(eventItem);
            }
        });                
    });

    // Append the category containers to the main container
    charityContainer.appendChild(donationContainer);
    charityContainer.appendChild(volunteerContainer);

    // Add event listener for filtering tags
    document.querySelectorAll('.category-block-link').forEach(tagLink => {
        tagLink.addEventListener('click', function (event) {
            event.preventDefault(); 

            const tag = event.target.getAttribute('data-tag');
            const isSelected = tagLink.classList.contains('tags-selected');

            if (isSelected) {
                tagLink.classList.remove('tags-selected');
                selectedTags = selectedTags.filter(t => t !== tag);
            } else {
                tagLink.classList.add('tags-selected');
                selectedTags.push(tag);
            }

            filterEventsByTags(organizations);
        });
    });
}

// Clear tag selection
const clearButton = document.getElementById('clear-selection');
clearButton.addEventListener('click', () => {

    document.querySelectorAll('.tags-block-link').forEach(link => {
        link.classList.remove('tags-selected');
        selectedTags = [];
    });

    filterEventsByTags(organizations);
});
