document.addEventListener('DOMContentLoaded', function() {
    const avatarImg = document.getElementById('avatarImg');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const logoutBtn = document.getElementById('logoutBtn');

    // 检查是否已登录
    function getLoginStatusFromCookie() {
        const cookies = document.cookie.split('; ');
        for (let cookie of cookies) {
            const [name, value] = cookie.split('=');
            if (name === 'isLoggedIn') {
                return value === 'true';
            }
        }
        return false;
    }

    // 在顶部先声明 isLoggedIn 变量
    const isLoggedIn = getLoginStatusFromCookie();
    console.log(isLoggedIn);


    // 登出功能
    logoutBtn.addEventListener('click', function(event) {
        event.preventDefault();
        document.cookie = "isLoggedIn=false; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/;";
        window.location.reload(); // 刷新页面
    });

    // 页面加载时显示登录状态
    if (isLoggedIn) {
        document.getElementById('loginBtn').style.display = 'none';
        //document.getElementById('registerBtn').style.display = 'none';
        document.getElementById('userAvatar').style.display = 'block';
    } else {
        document.getElementById('loginBtn').style.display = 'block';
        //document.getElementById('registerBtn').style.display = 'block';
        document.getElementById('userAvatar').style.display = 'none';
    }

    // 点击页面其他地方时隐藏菜单
    window.addEventListener('click', function(event) {
        if (!avatarImg.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
