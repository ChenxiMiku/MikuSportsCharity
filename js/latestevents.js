let selectedTags = []; 

async function fetchEvents() {
    try {
        const response = await fetch('/api/events');
        const organizations = await response.json();
        renderCharityEvents(organizations);
    } catch (error) {
        console.error('获取事件时出错:', error);
    }
}

// Sample organizations data
const organizations = [
    {
        charityName: "Kisckstarter Foundation",
        eventsData: [
            {
                title: "Charity Run 2024",
                url: "charity.html?organization=Kisckstarter%20Foundation",
                image: "images/hatsunemiku.JPG",
                tags: ["Running", "Fundraising"],
                date: "2024-05-01",
                author: "John Doe",
                comments: 20,
                summary: "Join us for a charity run to support health care."
            },
            {
                title: "Football  2024",
                url: "charity.html?organization=Kisckstarter%20Foundation",
                image: "images/hatsunemiku.JPG",
                tags: ["Donation", "Volunteering"],
                date: "2024-06-01",
                author: "Jane Doe",
                comments: 15,
                summary: "Join us for a charity run to support health care."
            }
        ]
    },
    {
        charityName: "Run for Life",
        eventsData: [
            {
                title: "Donation Drive",
                url: "charity.html?organization=Run%20for%20Life",
                image: "images/hatsunemiku.JPG",
                tags: ["Donation", "Children"],
                date: "2024-07-15",
                author: "Alice Smith",
                comments: 30,
                summary: "Join us for a charity run to support health care."
            },
            {
                title: "Summer Camp Fundraiser",
                url: "charity.html?organization=Run%20for%20Life",
                image: "images/hatsunemiku.JPG",
                tags: ["Fundraising", "Summer Camp"],
                date: "2024-08-10",
                author: "Bob Johnson",
                comments: 25,
                summary: "Join us for a charity run to support health care."
            }
        ]
    }
];

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

    organizations.forEach(organization => {
        const { charityName, eventsData } = organization;

        const charityHeader = document.createElement('div');
        charityHeader.classList.add('charity-header');
        charityHeader.innerHTML = `
            <a href="charity.html?organization=${charityName}" class="fs-1 fw-semibold">${charityName}</a>
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
}

document.addEventListener('DOMContentLoaded', () => {
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

    const clearButton = document.getElementById('clear-selection');
    clearButton.addEventListener('click', () => {
        document.querySelectorAll('.tags-block-link').forEach(link => {
            link.classList.remove('tags-selected');
            selectedTags = [];
        });

        filterEventsByTags(organizations);
    });
});
