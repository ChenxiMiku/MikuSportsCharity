document.addEventListener('DOMContentLoaded', function () {
    const logoutButtons = document.querySelectorAll('.logoutBtn');

    function getLoginStatusFromCookie() {
        const cookies = document.cookie.split('; ');
        for (let cookie of cookies) {
            const [name, value] = cookie.split('=');
            if (name === 'user_login') {
                // 解码 base64 编码的值
                const decodedValue = atob(value);
                
                // 发送请求到服务器验证解码后的 email 是否有效
                return verifyLogin(decodedValue);
            }
        }
        return false;
    }

    function verifyLogin(email) {
        // 使用 fetch 向服务器发送验证请求
        return fetch('../public/api/verifyLogin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email: email }),
        })
        .then(response => response.json())
        .then(data => {
            return data.success;
        })
        .catch(error => {
            console.error('Error verifying login:', error);
            return false;
        });
    }

    // 检查用户是否已登录
    const isLoggedIn = getLoginStatusFromCookie();

    // 根据登录状态显示不同内容
    if (isLoggedIn) {
        // 从服务器获取用户头像
        fetch('../public/api/getUserAvatar')  // 假设你有一个API接口返回用户头像信息
            .then(response => response.json())
            .then(data => {
                if (data.success && data.avatarUrl) {
                    // 如果成功获取到头像，则显示用户头像
                    document.getElementById('userAvatar').src = data.avatarUrl;
                    document.getElementById('userAvatar').classList.remove('d-none');
                }
            })
            .catch(error => {
                console.error('Error fetching user avatar:', error);
            });

        if (document.getElementById('loginBtn')) {
            document.getElementById('loginBtn').style.display = 'none';
        }
        document.getElementById('userAvatar').style.display = 'block';

    } else {
        if (document.getElementById('userLogin')) {
            document.getElementById('userLogin').classList.remove('d-none');
        }

        if (document.getElementById('loginBtn')) {
            document.getElementById('loginBtn').style.display = 'block';
        }
        document.getElementById('userAvatar').style.display = 'none';
    }

    // 处理退出登录
    logoutButtons.forEach(function (logoutBtn) {
        logoutBtn.addEventListener('click', function (event) {
            // 退出登录时删除用户登录的 cookie
            document.cookie = 'user_login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            localStorage.removeItem('previousPage');
            window.location.reload();
        });
    });
});
