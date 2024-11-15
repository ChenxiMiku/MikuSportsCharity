// 监听搜索输入框的键盘输入事件
const searchInput = document.getElementById('search');
searchInput.addEventListener('input', () => {
    const keyword = searchInput.value.trim().toLowerCase();
    filterEventsByKeyword(keyword);
});

// 按关键词筛选事件
function filterEventsByKeyword(keyword) {
    if (!keyword) {
        renderCharityEvents(organizations); // 如果没有输入关键词，显示所有事件
        return;
    }

    const filteredOrganizations = organizations.map(org => {
        const filteredEvents = org.eventsData.filter(event =>
            event.title.toLowerCase().includes(keyword) ||
            event.summary.toLowerCase().includes(keyword) ||
            event.tags.some(tag => tag.toLowerCase().includes(keyword))
        );
        return { ...org, eventsData: filteredEvents };
    }).filter(org => org.eventsData.length > 0); // 过滤掉没有匹配事件的组织

    renderCharityEvents(filteredOrganizations);
}
