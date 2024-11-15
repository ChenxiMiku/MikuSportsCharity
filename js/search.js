const searchInput = document.getElementById('search');
const searchBtn = document.querySelector('.search-btn');

searchInput.addEventListener('input', () => {
    const keyword = searchInput.value.trim().toLowerCase();
    searchBtn.disabled = !keyword; 
    filterEventsByKeyword(keyword); 
});

// 定义搜索按钮的点击事件，手动触发搜索
searchBtn.addEventListener('click', (e) => {
    e.preventDefault(); 
    const keyword = searchInput.value.trim().toLowerCase();
    filterEventsByKeyword(keyword); 
});

function filterEventsByKeyword(keyword) {
    if (!keyword) {
        renderCharityEvents(organizations); 
        return;
    }

    const filteredOrganizations = organizations.map(org => {
        const filteredEvents = org.eventsData.filter(event =>
            event.title.toLowerCase().includes(keyword) ||
            event.summary.toLowerCase().includes(keyword) ||
            event.tags.some(tag => tag.toLowerCase().includes(keyword))
        );
        return { ...org, eventsData: filteredEvents };
    }).filter(org => org.eventsData.length > 0); 

    renderCharityEvents(filteredOrganizations); 
}

document.addEventListener('DOMContentLoaded', () => {
    searchBtn.disabled = !searchInput.value.trim();
});
