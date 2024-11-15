document.addEventListener('DOMContentLoaded', function () {
    // 获取按钮和表单元素
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
    // 编辑按钮点击事件
    editButton.addEventListener('click', function () {
        // 隐藏信息部分
        informationSection.style.display = 'none';

        // 显示编辑表单
        editForm.style.display = 'block';

        // 填充编辑表单的默认值
        editOrganizationName.value = organizationNameDisplay.textContent;
        editEmail.value = emailDisplay.textContent;
        editPhone.value = phoneDisplay.textContent;
        editDateOfJoin.value = dateOfJoinDisplay.textContent;
        editYearsOfEstablishment.value = yearsOfEstablishmentDisplay.textContent;
        editAccountType.value = accountTypeDisplay.textContent;

    });

    // 保存按钮点击事件
    saveButton.addEventListener('click', function () {
        // 如果用户没有输入新值，则保留原来的值
        console.log(organizationNameDisplay)
        organizationNameDisplay.textContent = editOrganizationName.value.trim() || organizationNameDisplay.textContent;
        emailDisplay.textContent = editEmail.value.trim() || emailDisplay.textContent;
        phoneDisplay.textContent = editPhone.value.trim() || phoneDisplay.textContent;
        dateOfJoinDisplay.textContent = editDateOfJoin.value.trim() || dateOfJoinDisplay.textContent;
        yearsOfEstablishmentDisplay.textContent = editYearsOfEstablishment.value.trim() || yearsOfEstablishmentDisplay.textContent;
        accountTypeDisplay.textContent = editAccountType.value.trim() || accountTypeDisplay.textContent;

        // 隐藏编辑表单并显示更新后的内容
        editForm.style.display = 'none';
        informationSection.style.display = 'block';  // 显示信息部分
    });

    // 取消按钮点击事件
    cancelButton.addEventListener('click', function () {
        // 隐藏编辑表单并显示原始内容
        editForm.style.display = 'none';
        informationSection.style.display = 'block';  // 显示信息部分
    });
});
