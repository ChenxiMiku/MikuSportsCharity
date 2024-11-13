// 获取新闻列表数据
async function fetchevents() {
    try {
        const response = await fetch('/api/events');
        const eventsData = await response.json();
        renderevents(eventsData);
    } catch (error) {
        console.error('Error fetching events:', error);
    }
}

const eventsData = [
    {
        title: "Clothing donation to urban area",
        url: "events-detail.html",
        image: "images/events/medium-shot-volunteers-with-clothing-donations.jpg",
        date: "October 12, 2024",
        author: "Admin",
        comments: 32,
        summary: "Lorem Ipsum dolor sit amet...",
        tags: ["Donation", "Clothing"]
    },
    {
        title: "Food donation area",
        url: "events-detail.html",
        image: "images/events/medium-shot-people-collecting-foodstuff.jpg",
        date: "October 20, 2024",
        author: "Admin",
        comments: 35,
        summary: "Sed leo nisl, posuere at...",
        tags: ["Food", "Donation", "Caring"]
    },
    // 更多新闻数据
];

const charityNames = [
    "Charity A",
    "Charity B",
    "Charity C"
];

// 初次渲染所有新闻
renderCharityEvents(eventsData, charityNames[0]);

// 渲染新闻函数
function renderCharityEvents(data, charityName) {
    const charityContainer = document.getElementById('charity-events-container');
    charityContainer.innerHTML = ''; // 清空现有内容

    // 添加慈善机构名称
    const charityHeader = document.createElement('div');
    charityHeader.classList.add('charity-header');
    charityHeader.innerHTML = `
        <h2>活动列表: ${charityName}</h2>
        <p>以下是${charityName}组织的最新活动。</p>
    `;
    charityContainer.appendChild(charityHeader);

    // 创建活动列表容器，使用 d-flex 和 flex-wrap 使活动可以在一行内显示多个
    const eventsList = document.createElement('div');
    eventsList.id = 'events-list';
    eventsList.classList.add('d-flex', 'justify-content-start');
    charityContainer.appendChild(eventsList);

    // 渲染每个活动
    data.forEach(events => {
        const eventsItem = document.createElement('div');
        eventsItem.classList.add('events-block', 'mt-3', 'me-3', 'mb-3', 'custom-block-wrap'); // me-3 (margin end), mb-3 (margin bottom) 控制间距
        eventsItem.style.flex = '1 1 30%'; // 每个活动占据大约 30% 的宽度，剩下的空间会自动分配

        eventsItem.innerHTML = `
            <div class="events-block-top">
                <a href="${events.url}">
                    <img src="${events.image}" class="events-image img-fluid" alt="">
                </a>
                <div class="events-category-block">
                    ${events.tags.map(tag => `<a class="category-block-link">${tag}</a>`).join(', ')}
                </div>
            </div>
            <div class="events-block-info">
                <div class="d-flex mt-2">
                    <div class="events-block-date align-items-start">
                        <p><i class="bi-calendar4 custom-icon"></i> ${events.date}</p>
                    </div>
                    <div class="events-block-author align-items-end">
                        <p><i class="bi-person custom-icon"></i> By ${events.author}</p>
                    </div>
                </div>
                <div class="events-block-title mb-2">
                    <h4><a href="${events.url}" class="events-block-title-link">${events.title}</a></h4>
                </div>
                <div class="events-block-body">
                    <p>${events.summary}</p>
                </div>
            </div>
        `;
        eventsList.appendChild(eventsItem);
    });
}



// 定时刷新新闻数据
setInterval(fetchevents, 60000); // 每 60 秒刷新一次
fetchevents(); // 初次加载时调用一次

let selectedTags = []; // 用于存储选中标签的数组
// 根据当前选中的标签筛选新闻
function filtereventsByTags() {
    console.log(selectedTags)
    if (selectedTags.length === 0) {
      // 如果没有选中任何标签，显示所有新闻
      renderevents(eventsData);
    } else {
      // 筛选包含所有选中标签的新闻
      const filteredevents = eventsData.filter(events => 
        selectedTags.every(tag => events.tags.includes(tag))
      );
      renderevents(filteredevents);
    }
  }
  
  // 点击标签选择或取消选择新闻
  document.querySelectorAll('.tags-block-link').forEach(tagLink => {
    tagLink.addEventListener('click', function(event) {
      event.preventDefault(); // 阻止默认跳转
  
      const tag = event.target.getAttribute('data-tag');
  
      // 检查标签是否已选中
      const isSelected = tagLink.classList.contains('tags-selected');
  
      if (isSelected) {
        // 如果已选中，则移除选中状态并从selectedTags中删除
        tagLink.classList.remove('tags-selected');
        selectedTags = selectedTags.filter(t => t !== tag);
      } else {
        // 如果未选中，则添加选中状态并加入selectedTags
        tagLink.classList.add('tags-selected');
        selectedTags.push(tag);
      }
  
      // 根据当前选中的标签数组筛选新闻
      filtereventsByTags();
    });
  });
  
  // 一键清除选择
  const clearButton = document.getElementById('clear-selection');
  clearButton.addEventListener('click', () => {
    
    // 清除所有标签的选中状态
    document.querySelectorAll('.tags-block-link').forEach(link => {
      link.classList.remove('tags-selected');
      selectedTags = [];
    });
    // 显示所有新闻
    filtereventsByTags();
  });