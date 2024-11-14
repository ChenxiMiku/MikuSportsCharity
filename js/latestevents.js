let selectedTags = []; 

// Refresh news data regularly
//setInterval(fetchEvents, 60000); 
//fetchEvents(); 

// Get news list data, reserved interface
async function fetchEvents() {
    try {
        const response = await fetch('/api/events');
        const organizations = await response.json();
        renderCharityEvents(organizations);
    } catch (error) {
        console.error('Error fetching events:', error);
    }
}

const organizations = [
    {
        charityName: "Global Charity Organization",
        eventsData: [
            {
                title: "Charity Run 2024",
                url: "events-details.html",
                image: "https://t.alcy.cc/pc/",
                tags: ["Running", "Fundraising"],
                date: "2024-05-01",
                author: "John Doe",
                comments: 20,
                summary: "Join us for a charity run to support health care."
            },
            {
                title: "Food Drive 2024",
                url: "https://example.com/event/2",
                image: "https://t.alcy.cc/pc/",
                tags: ["Donation", "Volunteering"],
                date: "2024-06-01",
                author: "Jane Doe",
                comments: 15,
                summary: "Help us provide food to those in need."
            }
        ]
    },
    {
        charityName: "Local Children's Foundation",
        eventsData: [
            {
                title: "Toy Donation Drive",
                url: "https://example.com/event/3",
                image: "https://t.alcy.cc/pc/",
                tags: ["Donation", "Children"],
                date: "2024-07-15",
                author: "Alice Smith",
                comments: 30,
                summary: "Donate toys to bring joy to children in need."
            },
            {
                title: "Summer Camp Fundraiser",
                url: "https://example.com/event/4",
                image: "https://t.alcy.cc/pc/",
                tags: ["Fundraising", "Summer Camp"],
                date: "2024-08-10",
                author: "Bob Johnson",
                comments: 25,
                summary: "Help us raise funds for our annual summer camp."
            }
        ]
    }
];

renderCharityEvents(organizations);

function filterEventsByTags(organizations) {
    console.log(selectedTags);
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

    organizations.forEach(organization => {
        const { charityName, eventsData } = organization;

        const charityHeader = document.createElement('div');
        charityHeader.classList.add('charity-header');
        charityHeader.innerHTML = `
            <a href="charity.html" class="fs-1 fw-semibold">${charityName}</a>
            <p>Here are the latest events organized by ${charityName}.</p>
        `;
        charityContainer.appendChild(charityHeader);

        const eventsList = document.createElement('div');
        eventsList.classList.add('d-flex', 'flex-wrap', 'justify-content-start');
        charityContainer.appendChild(eventsList);

        eventsData.forEach(events => {
            const eventsItem = document.createElement('div');
            eventsItem.classList.add('events-block', 'mt-3', 'me-3', 'mb-3', 'custom-block-wrap'); 
            eventsItem.style.flex = '1 1 30%';

            eventsItem.innerHTML = `
                <div class="events-block-top">
                    <a href="${events.url}">
                        <img src="${events.image}" class="events-image img-fluid" alt="">
                    </a>
                    <div class="events-category-block">
                        ${events.tags.map(tag => `<a class="category-block-link" data-tag="${tag}">${tag}</a>`).join(', ')}
                    </div>
                </div>
                <div class="events-block-info">
                    <div class="d-flex mt-2">
                        <div class="ms-4 events-block-date">
                            <p><i class="bi-calendar4 custom-icon"></i> ${events.date}</p>
                        </div>
                    </div>
                    <div class="events-block-title mb-2 ms-4">
                        <h4><a href="${events.url}" class="events-block-title-link">${events.title}</a></h4>
                    </div>
                    <div class="events-block-body ms-4">
                        <p>${events.summary}</p>
                    </div>
                </div>
            `;
            eventsList.appendChild(eventsItem);
        });
    });


    document.querySelectorAll('.tags-block-link').forEach(tagLink => {
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

const clearButton = document.getElementById('clear-selection');
clearButton.addEventListener('click', () => {

    document.querySelectorAll('.tags-block-link').forEach(link => {
        link.classList.remove('tags-selected');
        selectedTags = [];
    });

    filterEventsByTags(organizations);
});
