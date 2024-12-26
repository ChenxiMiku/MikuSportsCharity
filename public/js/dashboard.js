// DOM Element Selectors
const getSideBar = document.querySelector(".sidebar");
const getPageContent = document.querySelector(".page-content");
const getLoader = document.querySelector(".loader");
const getToggle = document.querySelectorAll(".toggle");
const getHeart = document.querySelector(".heart");

// Page sections
const sections = {
    Dashboard: document.querySelector("#Dashboard"),
    Profile: document.querySelector("#Profile"),
    Donation: document.querySelector("#Donation"),
    Events: document.querySelector("#Events"),
};

// State
let displayedPage = sections.Dashboard; // Default displayed page is Dashboard

// Functions

// Switch Page
function switchPage(page) {
    if (displayedPage) displayedPage.hidden = true;
    displayedPage = page;
    displayedPage.hidden = false;
}

// Avatar Upload
function setupAvatarUpload(avatarInputId, avatars) {
    const avatarInput = document.getElementById(avatarInputId);
    avatars.forEach(avatar => {
        avatar.onclick = () => avatarInput.click();
    });

    avatarInput.onchange = (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const uploadedImageUrl = e.target.result;
                avatars.forEach(img => (img.src = uploadedImageUrl));
            };
            reader.readAsDataURL(file);
        }
    };
}

// Heart Icon Toggle
function setupHeartToggle(heartElement) {
    heartElement?.addEventListener("click", () => {
        const isRegular = heartElement.classList.contains("fa-regular");
        heartElement.classList.toggle("fa-regular", !isRegular);
        heartElement.classList.toggle("fa-solid", isRegular);
        heartElement.style.color = isRegular ? "red" : "#888";
    });
}

// Close Sidebar on Outside Click or Scroll
function closeSidebarOnOutsideClick() {
    document.onclick = (e) => {
        if (getSideBar.classList.contains("sidebar-active") &&
            !e.target.closest(".sidebar, .brand, .brand-name")) {
            getSideBar.classList.remove("sidebar-active");
        }
    };

    window.onscroll = () => {
        if (getSideBar.classList.contains("sidebar-active")) {
            getSideBar.classList.remove("sidebar-active");
        }
    };
}

// Loader Handling
function handleLoader(loaderElement, pageContent) {
    window.onload = () => {
        if (loaderElement) loaderElement.style.display = "none";
        if (pageContent) pageContent.style.display = "grid";
    };
}

// Initialization
function initialize() {
    // Avatar upload setup
    setupAvatarUpload("avatarInput", document.querySelectorAll('img[id^="avatar"]'));

    // Heart toggle
    setupHeartToggle(getHeart);

    // Close sidebar on outside click or scroll
    closeSidebarOnOutsideClick();

    // Handle loader display
    handleLoader(getLoader, getPageContent);
}

// Run Initialization
document.addEventListener("DOMContentLoaded", initialize);
