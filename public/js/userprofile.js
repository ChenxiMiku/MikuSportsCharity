document.addEventListener("DOMContentLoaded", () => {
    // 定义获取数据的函数
    const fetchUserData = async () => {
        try {
            const response = await fetch('../public/api/getUserDetails');
            const data = await response.json();

            if (data.error) {
                console.error(data.error);
                return;
            }
            document.getElementById('userName1').textContent = data.user.username;
            document.getElementById('name').textContent = data.user.name;
            document.getElementById('email').textContent = data.user.email;
            document.getElementById('phone').textContent = data.user.contact_number;
            document.getElementById('dateOfJoin').textContent = data.user.created_at;
            document.getElementById('accountType').textContent = data.user.role;
            document.getElementById('userAvatar1').src = data.user.avatar_path ? data.user.avatar_path : 'images/test/testavatar.png';

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    fetchUserData();
});