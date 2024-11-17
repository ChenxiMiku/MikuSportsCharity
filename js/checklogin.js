document.addEventListener('DOMContentLoaded', function () {
const logoutButtons = document.querySelectorAll('.logoutBtn');

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

const isLoggedIn = getLoginStatusFromCookie();


logoutButtons.forEach(function (logoutBtn) {
    logoutBtn.addEventListener('click', function (event) {
        //event.preventDefault();
        document.cookie = "isLoggedIn=false; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/;";
        localStorage.removeItem('previousPage');
        window.location.reload();
    });
});


if (isLoggedIn) {

    document.getElementById('userAvatar').classList.remove('d-none');
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
});
