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

const organizations = [
    {
        charityName: "Global Charity Organization",
        eventsData: [
            {
                title: "Charity Run 2024",
                url: "https://example.com/event/1",
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

// 调用函数渲染多个慈善机构的活动

// 初次渲染所有新闻
renderCharityEvents(organizations);

// 渲染多个慈善机构的活动函数
function renderCharityEvents(organizations) {
    const charityContainer = document.getElementById('charity-events-container');
    charityContainer.innerHTML = ''; // 清空现有内容

    // 遍历每个慈善机构的数据
    organizations.forEach(organization => {
        const { charityName, eventsData } = organization;

        // 添加慈善机构名称
        const charityHeader = document.createElement('div');
        charityHeader.classList.add('charity-header');
        charityHeader.innerHTML = `
            <h2>${charityName}</h2>
            <p>以下是${charityName}组织的最新活动。</p>
        `;
        charityContainer.appendChild(charityHeader);

        // 创建活动列表容器，使用 d-flex 和 flex-wrap 使活动可以在一行内显示多个
        const eventsList = document.createElement('div');
        eventsList.classList.add('d-flex', 'flex-wrap', 'justify-content-start'); // flex-wrap 保证活动换行显示
        charityContainer.appendChild(eventsList);

        // 渲染每个活动
        eventsData.forEach(events => {
            const eventsItem = document.createElement('div');
            eventsItem.classList.add('events-block', 'mt-3', 'me-3', 'mb-3', 'custom-block-wrap'); // 控制间距
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
                        <div class="ms-4 events-block-date">
                            <p><i class="bi-calendar4 custom-icon"></i> ${events.date}</p>
                        </div>
                        <div class="ms-4 events-block-author">
                            <p><i class="bi-person custom-icon"></i> By ${events.author}</p>
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