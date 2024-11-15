function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();

    // 这里可以发送用户信息到后端进行处理
    // 例如: 
    // fetch('/auth/google', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json'
    //     },
    //     body: JSON.stringify({
    //         id: profile.getId(),
    //         name: profile.getName(),
    //         email: profile.getEmail()
    //     })
    // }).then(response => {
    //     // 处理服务器响应
    // });
}

document.getElementById('googleSignIn').addEventListener('click', function() {
    // 使用 Google API 处理登录
    gapi.load('auth2', function() {
        auth2 = gapi.auth2.init({
            client_id: '379679355500-piukmcvjv1meo8tdt371dv9rd2s4lckj.apps.googleusercontent.com', // 替换为您的客户端 ID
        });
        auth2.signIn().then(onSignIn);
    });
});

