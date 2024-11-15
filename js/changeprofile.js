document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('editButton');
    const editForm = document.getElementById('editForm');
    const saveButton = document.getElementById('saveButton');
    const cancelButton = document.getElementById('cancelButton');

    const organizationNameDisplay = document.getElementById('organizationName');
    const emailDisplay = document.getElementById('email');
    const phoneDisplay = document.getElementById('phone');
    const dateOfJoinDisplay = document.getElementById('dateOfJoin');
    const yearsOfEstablishmentDisplay = document.getElementById('yearsOfEstablishment');
    const accountTypeDisplay = document.getElementById('accountType');

    const editOrganizationName = document.getElementById('editOrganizationName');
    const editEmail = document.getElementById('editEmail');
    const editPhone = document.getElementById('editPhone');
    const editDateOfJoin = document.getElementById('editDateOfJoin');
    const editYearsOfEstablishment = document.getElementById('editYearsOfEstablishment');
    const editAccountType = document.getElementById('editAccountType');

    const informationSection = document.getElementById('informationSection');  
    editForm.style.display = 'none';
    editButton.addEventListener('click', function () {
        informationSection.style.display = 'none';
        editForm.style.display = 'block';
        editOrganizationName.value = organizationNameDisplay.textContent;
        editEmail.value = emailDisplay.textContent;
        editPhone.value = phoneDisplay.textContent;
        editDateOfJoin.value = dateOfJoinDisplay.textContent;
        editYearsOfEstablishment.value = yearsOfEstablishmentDisplay.textContent;
        editAccountType.value = accountTypeDisplay.textContent;

    });

    saveButton.addEventListener('click', function () {
        console.log(organizationNameDisplay)
        organizationNameDisplay.textContent = editOrganizationName.value.trim() || organizationNameDisplay.textContent;
        emailDisplay.textContent = editEmail.value.trim() || emailDisplay.textContent;
        phoneDisplay.textContent = editPhone.value.trim() || phoneDisplay.textContent;
        dateOfJoinDisplay.textContent = editDateOfJoin.value.trim() || dateOfJoinDisplay.textContent;
        yearsOfEstablishmentDisplay.textContent = editYearsOfEstablishment.value.trim() || yearsOfEstablishmentDisplay.textContent;
        accountTypeDisplay.textContent = editAccountType.value.trim() || accountTypeDisplay.textContent;

        editForm.style.display = 'none';
        informationSection.style.display = 'block';
    });


    cancelButton.addEventListener('click', function () {

        editForm.style.display = 'none';
        informationSection.style.display = 'block';
    });
});
