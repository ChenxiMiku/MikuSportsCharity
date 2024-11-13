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

});
