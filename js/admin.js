let getBarItem = document.querySelector(".bar-item");
let getSideBar = document.querySelector(".sidebar");
let getXmark = document.querySelector(".xmark");
let getPageContent = document.querySelector(".page-content");
let getLoader = document.querySelector(".loader");
let getSidebarLink = document.querySelectorAll(".sidebar-link");
let getDashboard = document.querySelector("#Dashboard");
let getProfile = document.querySelector("#Profile");
let getEvents = document.querySelector("#Events");
let getAdmission = document.querySelector("#Admission");
let getDashboard_Side = document.querySelector("#Dashboard-Side");
let getProfile_Side = document.querySelector("#Profile-Side");
let getEvents_Side = document.querySelector("#Events-Side");
let getAdmission_Side = document.querySelector("#Admission-Side");
let activePage = window.location.pathname;
let getSideBarStatus = false;
let displayPage = getDashboard; // 默认显示的页面是 Dashboard

getBarItem.onclick = () => {
  getSideBar.style = "transform: translateX(0px);width:220px";
  getSideBar.classList.add("sidebar-active");
};

getXmark.onclick = () => {
  getSideBar.style =
    "transform: translateX(-220px);width:220px;box-shadow:none;";
  getSideBarStatus = true;
  if (getSideBar.classList.contains("sidebar-active")) {
    getSideBar.classList.remove("sidebar-active");
  }
};

function switchPage(page) {
  displayPage.hidden = true;
  displayPage = page;
  displayPage.hidden = false;
}

getDashboard_Side.onclick = () => switchPage(getDashboard);
getProfile_Side.onclick = () => switchPage(getProfile);
getEvents_Side.onclick = () => switchPage(getEvents);
getAdmission_Side.onclick = () => switchPage(getAdmission);

window.addEventListener("resize", (e) => {
  if (getSideBarStatus === true) {
    if (e.target.innerWidth > 768) {
      getSideBar.style = "transform: translateX(0px);width:220px";
    } else {
      getSideBar.style =
        "transform: translateX(-220px);width:220px;box-shadow:none;";
    }
  }
});

if (getLoader) {
  window.addEventListener("load", () => {
    getLoader.style.display = "none";
    getPageContent.style.display = "grid";
    activePage = "index.html";
    getSidebarLink.forEach((item) => {
      if (item.href.includes(`${activePage}`)) {
        item.classList.add("active");
      } else item.classList.remove("active");
    });
  });
}

document.onclick = (e) => {
  if (getSideBar.classList.contains("sidebar-active")) {
    if (
      !e.target.classList.contains("bar-item") &&
      !e.target.classList.contains("sidebar") &&
      !e.target.classList.contains("brand") &&
      !e.target.classList.contains("brand-name")
    ) {
      getSideBar.style =
        "transform: translateX(-220px);width:220px;box-shadow:none;";
      getSideBar.classList.remove("sidebar-active");
      getSideBarStatus = true;
    }
  }
};

window.addEventListener("scroll", () => {
  if (getSideBar.classList.contains("sidebar-active")) {
    getSideBar.style =
      "transform: translateX(-220px);width:220px;box-shadow:none;";
    getSideBar.classList.remove("sidebar-active");
  }
});

getSidebarLink.forEach((item) => {
  if (item.href.includes(`${activePage}`)) {
    item.classList.add("active");
  }
});
