const charityData = [
    {
        title: "Charity Run 2024",
        url: "#",
        image: "images/hatsunemiku.JPG",
        tags: ["Running", "Fundraising"],
        date: "2024-05-01",
        author: "John Doe",
        comments: 20,
        summary: "Join us for a charity run to support health care."
    },
    {
        title: "Food Drive 2024",
        url: "#",
        image: "images/hatsunemiku.JPG",
        tags: ["Donation", "Volunteering"],
        date: "2024-06-01",
        author: "Jane Doe",
        comments: 15,
        summary: "Help us provide food to those in need."
    }
];

renderCharityEvents(charityData);

function renderCharityEvents(data) {
    const charityContainer = document.getElementById('charity-events-container');
    charityContainer.innerHTML = ''; 
    const eventsList = document.createElement('div');
    eventsList.id = 'events-list';
    eventsList.classList.add('d-flex', 'flex-wrap', 'justify-content-start');
    charityContainer.appendChild(eventsList);

    data.forEach(events => {
        const eventsItem = document.createElement('div');
        eventsItem.classList.add('myevents-block', 'mt-3', 'me-3', 'mb-3', 'custom-block-wrap'); 
        eventsItem.style.flex = '1 1 30%';

        eventsItem.innerHTML = `
                <div class="events-block-top">
                    <a href="${events.url}">
                        <img src="${events.image}" class="events-image img-fluid" alt="">
                    </a>
                    <div class="myevents-category-block">
                        ${events.tags.map(tag => `<a class="mycategory-block-link" data-tag="${tag}">${tag}</a>`).join(' ')}
                    </div>
                </div>
                <div class="events-block-info">
                    <div class="d-flex mt-2">
                        <div class="ms-4 events-block-date">
                            <p><i class="bi-calendar4 custom-icon-primary"></i> ${events.date}</p>
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
}

