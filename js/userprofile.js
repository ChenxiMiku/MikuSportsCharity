document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('editButton');
    const editForm = document.getElementById('editForm');
    const saveButton = document.getElementById('saveButton');
    const cancelButton = document.getElementById('cancelButton');

    const userNameDisplay = document.getElementById('userName');
    const emailDisplay = document.getElementById('email');
    const phoneDisplay = document.getElementById('phone');
    const dateOfJoinDisplay = document.getElementById('dateOfJoin');
    const accountTypeDisplay = document.getElementById('accountType');

    const editOrganizationName = document.getElementById('editOrganizationName');
    const editEmail = document.getElementById('editEmail');
    const editPhone = document.getElementById('editPhone');
    const editDateOfJoin = document.getElementById('editDateOfJoin');
    const editAccountType = document.getElementById('editAccountType');

    const informationSection = document.getElementById('informationSection');
    editForm.style.display = 'none';

    editButton.addEventListener('click', function () {
        informationSection.style.display = 'none';

        editForm.style.display = 'block';

        editUserName.value = userNameDisplay.textContent.trim();
        editEmail.value = emailDisplay.textContent.trim();
        editPhone.value = phoneDisplay.textContent.trim();
        editDateOfJoin.value = dateOfJoinDisplay.textContent.trim();
        editAccountType.value = accountTypeDisplay.textContent.trim();
    });

    saveButton.addEventListener('click', function () {

        userNameDisplay.textContent = editUserName.value.trim() || userNameDisplay.textContent.trim();
        emailDisplay.textContent = editEmail.value.trim() || emailDisplay.textContent.trim();
        phoneDisplay.textContent = editPhone.value.trim() || phoneDisplay.textContent.trim();
        dateOfJoinDisplay.textContent = editDateOfJoin.value.trim() || dateOfJoinDisplay.textContent.trim();
        accountTypeDisplay.textContent = editAccountType.value.trim() || accountTypeDisplay.textContent.trim();

        editForm.style.display = 'none';
        informationSection.style.display = 'block'; 
    });

    cancelButton.addEventListener('click', function () {
        editForm.style.display = 'none';
        informationSection.style.display = 'block';  
    });
});
