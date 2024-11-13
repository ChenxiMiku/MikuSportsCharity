// DOM Element Selectors
const getBarItem = document.querySelector(".bar-item");
const getSideBar = document.querySelector(".sidebar");
const getXmark = document.querySelector(".xmark");
const getPageContent = document.querySelector(".page-content");
const getLoader = document.querySelector(".loader");
const getToggle = document.querySelectorAll(".toggle");
const getHeart = document.querySelector(".heart");
const getSidebarLinks = document.querySelectorAll(".sidebar-link");

// Page sections
const sections = {
    Dashboard: document.querySelector("#Dashboard"),
    Profile: document.querySelector("#Profile"),
    Donation: document.querySelector("#Donation"),
    Events: document.querySelector("#Events"),
};

// Sidebar links to sections
const sidebarLinks = {
    Dashboard: document.querySelector("#Dashboard-Side"),
    Profile: document.querySelector("#Profile-Side"),
    Donation: document.querySelector("#Donation-Side"),
    Events: document.querySelector("#Events-Side"),
};

// State
let getSideBarStatus = false;
let activePage = window.location.pathname;
let displayedPage = sections.Dashboard; // Default displayed page is Dashboard

// Sidebar Toggle Functions
getBarItem.onclick = () => {
    getSideBar.style.transform = "translateX(0px)";
    getSideBar.classList.add("sidebar-active");
};

getXmark.onclick = () => {
    getSideBar.style.transform = "translateX(-220px)";
    getSideBar.classList.remove("sidebar-active");
    getSideBarStatus = true;
};

// Page Switching Function
function switchPage(page) {
    displayedPage.hidden = true;
    displayedPage = page;
    displayedPage.hidden = false;
}

// Link the sidebar links to their corresponding sections
Object.keys(sidebarLinks).forEach(key => {
    sidebarLinks[key].onclick = () => switchPage(sections[key]);
});

// Event Block Toggle Function
function toggleBlocks(eventBlock, outterBlock, innerBlock, eventBack) {
    eventBlock.onclick = () => {
        outterBlock.hidden = true;
        innerBlock.hidden = false;
    };

    eventBack.onclick = (event) => {
        event.stopPropagation();
        innerBlock.hidden = true;
        outterBlock.hidden = false;
    };
}

// Editable Text Function
function setupEditableText(textDisplayId, editContainerId, editInputId, confirmButtonId) {
    const textDisplay = document.getElementById(textDisplayId);
    const editContainer = document.getElementById(editContainerId);
    const editInput = document.getElementById(editInputId);
    const confirmButton = document.getElementById(confirmButtonId);

    textDisplay.onclick = () => {
        editInput.value = textDisplay.textContent;
        textDisplay.style.display = 'none';
        editContainer.style.display = 'inline-block';
    };

    confirmButton.onclick = () => {
        textDisplay.textContent = editInput.value;
        textDisplay.style.display = 'inline-block';
        editContainer.style.display = 'none';
    };
}

// Avatar Image Upload Functionality
const avatarInput = document.getElementById('avatarInput');
document.getElementById('avatar5').onclick = () => avatarInput.click();

avatarInput.onchange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const uploadedImageUrl = e.target.result;
            document.querySelectorAll('img[id^="avatar"]').forEach(img => img.src = uploadedImageUrl);
        };
        reader.readAsDataURL(file);
    }
};

// Responsive Sidebar Adjustment on Resize
window.onresize = (e) => {
    if (getSideBarStatus) {
        getSideBar.style.transform = e.target.innerWidth > 768 ? "translateX(0px)" : "translateX(-220px)";
    }
};

// Hide Loader and Display Content on Page Load
if (getLoader) {
    window.onload = () => {
        getLoader.style.display = "none";
        getPageContent.style.display = "grid";
        getSidebarLinks.forEach(item => item.classList.toggle("active", item.href.includes(activePage)));
    };
}

// Close Sidebar on Outside Click or Scroll
document.onclick = (e) => {
    if (getSideBar.classList.contains("sidebar-active") &&
        !e.target.closest(".bar-item, .sidebar, .brand, .brand-name")) {
        getSideBar.style.transform = "translateX(-220px)";
        getSideBar.classList.remove("sidebar-active");
        getSideBarStatus = true;
    }
};

window.onscroll = () => {
    if (getSideBar.classList.contains("sidebar-active")) {
        getSideBar.style.transform = "translateX(-220px)";
        getSideBar.classList.remove("sidebar-active");
    }
};

// Toggle Heart Icon Style
getHeart?.addEventListener("click", (e) => {
    const isRegular = e.target.classList.contains("fa-regular");
    getHeart.classList.toggle("fa-regular", !isRegular);
    getHeart.classList.toggle("fa-solid", isRegular);
    getHeart.style.color = isRegular ? "red" : "#888";
});

// Toggle Block Functionality for Sidebar
getToggle.forEach(item => {
    item.onclick = () => item.classList.toggle("left");
});
