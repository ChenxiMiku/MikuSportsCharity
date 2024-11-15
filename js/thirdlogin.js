function onSignIn(googleUser) {
    let profile = googleUser.getBasicProfile();
}

document.getElementById('googleSignIn').addEventListener('click', function() {
    gapi.load('auth2', function() {
        auth2 = gapi.auth2.init({
            client_id: '379679355500-piukmcvjv1meo8tdt371dv9rd2s4lckj.apps.googleusercontent.com',
        });
        auth2.signIn().then(onSignIn);
    });
});

