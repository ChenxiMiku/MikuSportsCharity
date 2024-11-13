let getBarItem = document.querySelector(".bar-item");
let getSideBar = document.querySelector(".sidebar");
let getXmark = document.querySelector(".xmark");
let getPageContent = document.querySelector(".page-content");
let getLoader = document.querySelector(".loader");
let getToggle = document.querySelectorAll(".toggle");
let getHeart = document.querySelector(".heart");
let getSidebarLink = document.querySelectorAll(".sidebar-link");
let getDashboard = document.querySelector("#Dashboard")
let getProfile = document.querySelector("#Profile")
let getEvents = document.querySelector("#Events")
let getDashboard_Side = document.querySelector("#Dashboard-Side")
let getProfile_Side = document.querySelector("#Profile-Side")
let getEvents_Side = document.querySelector("#Events-Side")
let getDashPro = document.querySelector("#dash-pro")
let eventBlock1 = document.getElementById('eventblock1');
let outterBlock1 = document.getElementById('EventBlockOutter1');
let innerBlock1 = document.getElementById('EventBlockInner1');
let eventBack1 = document.getElementById('eventBack1');
let eventBlock2 = document.getElementById('eventblock2');
let outterBlock2 = document.getElementById('EventBlockOutter2');
let innerBlock2 = document.getElementById('EventBlockInner2');
let eventBack2 = document.getElementById('eventBack2');
let eventBlock3 = document.getElementById('eventblock3');
let outterBlock3 = document.getElementById('EventBlockOutter3');
let innerBlock3 = document.getElementById('EventBlockInner3');
let eventBack3 = document.getElementById('eventBack3');
let profileEditBt = document.getElementById('profile-edit-bt')
// let textDisplay = document.getElementById('textDisplay');
// let editContainer = document.getElementById('editContainer');
// let editInput = document.getElementById('editInput');
// let confirmButton = document.getElementById('confirmButton');
let activePage = window.location.pathname;
let getSideBarStatus = false;
let Display_Page = getDashboard; // Default displayed page is Dashboard

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
  console.log("display " + page.id)
  Display_Page.hidden = true;
  Display_Page = page;
  Display_Page.hidden = false;
}

getDashboard_Side.onclick = () => switchPage(getDashboard);
getProfile_Side.onclick = () => switchPage(getProfile);
getEvents_Side.onclick = () => switchPage(getEvents);
getDashPro.onclick = () => switchPage(getProfile);


function toggleBlocks(eventBlock, outterBlock, innerBlock, eventBack) {
  eventBlock.addEventListener('click', (event) => {
      console.log("inner");
      outterBlock.hidden = true;
      innerBlock.hidden = false;
  });

  eventBack.addEventListener('click', (event) => {
      event.stopPropagation();
      console.log("outter");
      innerBlock.hidden = true;
      outterBlock.hidden = false;
  });
}



function setupEditableText(textDisplayId, editContainerId, editInputId, confirmButtonId) {
  const textDisplay = document.getElementById(textDisplayId);
  const editContainer = document.getElementById(editContainerId);
  const editInput = document.getElementById(editInputId);
  const confirmButton = document.getElementById(confirmButtonId);

  // 点击文本时显示编辑框并隐藏文本显示
  textDisplay.addEventListener('click', () => {
      editInput.value = textDisplay.textContent; // 设置输入框默认值为当前文本
      textDisplay.style.display = 'none'; // 隐藏文本显示
      editContainer.style.display = 'inline-block'; // 显示编辑框
      editContainer.style.setProperty('display', 'inline-block', 'important'); // 使用 !important 强制显示
  });

  // 点击确认按钮时更新文本并隐藏编辑框
  confirmButton.addEventListener('click', () => {
      textDisplay.textContent = editInput.value; // 更新文本
      textDisplay.style.setProperty('display', 'inline-block', 'important'); // 使用 !important 强制显示
      editContainer.style.setProperty('display', 'none', 'important'); // 使用 !important 强制隐藏
  });
}








// 点击 Confirm 按钮后，检查密码是否一致
confirmButton.addEventListener('click', () => {
    const newPassword = editPasswd7.value;
    const confirmPassword = editConfirmPasswd7.value;

    if (!newPassword || !confirmPassword) {
      errorMessage7.textContent = 'Please enter the password in both fields.';
      errorMessage7.style.display = 'block';
      return;
    }

    if (newPassword === confirmPassword) {
        // 密码一致，隐藏输入框，重新显示 Change 按钮
        editContainer7.style.display = 'none';
        changeButton7.style.display = 'block';
        errorMessage7.style.display = 'none'; // 隐藏错误信息
        alert('Password successfully changed!');
    } else {
        // 密码不一致，显示错误信息
        errorMessage7.textContent = 'Passwords do not match. Please try again.';
        errorMessage7.style.display = 'block';
    }
});






// 获取所有带有 avatar 尾标的 img 标签
const avatarImages = document.querySelectorAll('img[id^="avatar"]');
const avatarInput = document.getElementById('avatarInput');
const avatar5 = document.getElementById('avatar5');

// 监听点击事件，当点击 avatar5 时触发文件选择框
avatar5.addEventListener('click', () => {
    avatarInput.click(); // 显示文件选择框
});

// 监听文件选择事件
avatarInput.addEventListener('change', (event) => {
    const file = event.target.files[0]; // 获取用户选择的文件
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const uploadedImageUrl = e.target.result; // 获取图片的 URL
            // 更新所有 avatar 的图片
            avatarImages.forEach(img => {
                img.src = uploadedImageUrl; // 更新 src 为用户上传的图片
            });
        };
        reader.readAsDataURL(file); // 读取用户选择的文件为 Data URL
    }
});



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
if (getHeart) {
  getHeart.addEventListener("click", (e) => {
    if (e.target.classList.contains("fa-regular")) {
      getHeart.classList.replace("fa-regular", "fa-solid");
      getHeart.style.color = "red";
    } else {
      getHeart.classList.replace("fa-solid", "fa-regular");
      getHeart.style.color = "#888";
    }
  });
}
getToggle.forEach((item) => {
  item.addEventListener("click", () => {
    if (item.classList.contains("left")) {
      item.classList.remove("left");
    } else {
      item.classList.add("left");
    }
  });
});

getSidebarLink.forEach((item) => {
  if (item.href.includes(`${activePage}`)) {
    item.classList.add("active");
  }
});
