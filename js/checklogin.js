/*document.addEventListener('DOMContentLoaded', function() {
    // 假设有一个API可以返回用户的登录状态和头像URL
    fetch('/api/check-login')
        .then(response => response.json())
        .then(data => {
            data.isLoggedIn = true; // 假设用户已登录
            if (data.isLoggedIn) {
                // 用户已登录，隐藏登录和注册按钮，显示用户头像
                document.getElementById('loginBtn').style.display = 'none';
                document.getElementById('registerBtn').style.display = 'none';
                document.getElementById('avatarImg').src = data.avatarUrl;
                document.getElementById('userAvatar').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error checking login status:', error);
        });
});*/
document.addEventListener('DOMContentLoaded', function() {
    // 假设有一个API可以返回用户的登录状态和头像URL
    data = {};
    data.isLoggedIn = false; // 假设用户已登录
    if (data.isLoggedIn) {
                // 用户已登录，隐藏登录和注册按钮，显示用户头像
        document.getElementById('loginBtn').style.display = 'none';
        document.getElementById('registerBtn').style.display = 'none';
        //document.getElementById('avatarImg').src = data.avatarUrl;
        document.getElementById('userAvatar').style.display = 'block';
    }
    else{
        document.getElementById('loginBtn').style.display = 'block';
        document.getElementById('registerBtn').style.display = 'block';
        document.getElementById('userAvatar').style.display = 'none';
    }
});