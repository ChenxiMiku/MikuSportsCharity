// script.js

document.addEventListener("DOMContentLoaded", function() {
    // 获取页面元素
    const eventSection = document.getElementById("event-section");
    const formSection = document.getElementById("form-section");
    const nextButton = document.getElementById("nextBtn");
    const previousButton = document.getElementById("previousBtn");
    const skipButton = document.getElementById("skipBtn");

    // 设置初始状态
    eventSection.classList.add("active");
    formSection.style.display = "none"; // 隐藏表单部分

    // "下一步"按钮和"跳过"按钮的点击事件监听
    nextButton.addEventListener("click", handleNextButtonClick);
    skipButton.addEventListener("click", function() {
        handleNextButtonClick();
        resetCheckboxes();  // 跳过时取消所有选择
    });

    previousButton.addEventListener("click", handlePreviousButtonClick);

    // 绑定所有以 "eventDiv" 开头的 div 点击事件
    const divs = document.querySelectorAll('[id^="eventDiv"]');
    divs.forEach(div => {
        div.addEventListener('click', toggleCheckbox);
    });
});

// 切换复选框状态的函数
function toggleCheckbox(event) {
    const divId = event.currentTarget.id;
    const checkboxId = divId.replace("eventDiv", "event");
    const checkbox = document.getElementById(checkboxId);

    // 如果点击的不是复选框或标签，切换 checkbox 状态
    if (event.target.tagName !== 'INPUT' && event.target.tagName !== 'LABEL' && checkbox) {
        checkbox.checked = !checkbox.checked;
    }
    // 更新 "下一步"按钮的状态
    const nextButton = document.getElementById("nextBtn");
    nextButton.disabled = !checkbox.checked;
}

// "下一步" 和 "跳过"按钮点击事件处理
function handleNextButtonClick() {
    const eventSection = document.getElementById("event-section");
    const formSection = document.getElementById("form-section");

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
// "上一步"按钮点击事件处理
function handlePreviousButtonClick() {
    const eventSection = document.getElementById("event-section");
    const formSection = document.getElementById("form-section");

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

// 取消所有复选框选择的函数
function resetCheckboxes() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    // 禁用“下一步”按钮
    document.getElementById("nextBtn").disabled = true;
}
