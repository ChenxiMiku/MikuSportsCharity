document.addEventListener("DOMContentLoaded", function () {
    // 管理慈善机构
    const charityForm = document.getElementById("addCharityForm");
    const charityList = document.getElementById("charityList");

    charityForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const charityName = document.getElementById("charityName").value.trim();

        if (!charityName || !charityEmail || !charityPhone) {
            alert("Please fill in all fields.");
            return;
        }

        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>${charityName}</td>
            <td>
                <button class="edit-btn btn btn-warning btn-sm">Edit</button>
                <button class="delete-btn btn btn-danger btn-sm">Delete</button>
            </td>`;

        charityList.appendChild(newRow);
        charityForm.reset();

        alert("Charity added successfully.");
    });

    charityList.addEventListener("click", function (e) {
        if (e.target.classList.contains("edit-btn")) {
            const row = e.target.closest("tr");
            const nameCell = row.children[0];
            const emailCell = row.children[1];
            const phoneCell = row.children[2];

            const newName = prompt("Edit Charity Name:", nameCell.textContent);
            const newEmail = prompt("Edit Charity Email:", emailCell.textContent);
            const newPhone = prompt("Edit Charity Phone:", phoneCell.textContent);

            if (newName) nameCell.textContent = newName;
            if (newEmail) emailCell.textContent = newEmail;
            if (newPhone) phoneCell.textContent = newPhone;
        } else if (e.target.classList.contains("delete-btn")) {
            if (confirm("Are you sure you want to delete this charity?")) {
                e.target.closest("tr").remove();
            }
        }
    });

    // 发布活动
    const activityForm = document.getElementById("publishActivityForm");

    activityForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const activityTitle = document.getElementById("activityTitle").value.trim();
        const activityDescription = document.getElementById("activityDescription").value.trim();
        const activityType = document.getElementById("activityType").value.trim();
        const activityDate = document.getElementById("activityDate").value.trim();
        const activityLocation = document.getElementById("activityLocation").value.trim();

        if (!activityTitle || !activityDescription || !activityType || !activityDate || !activityLocation) {
            alert("Please fill in all fields.");
            return;
        }

        alert(`Activity published successfully:\nTitle: ${activityTitle}\nDescription: ${activityDescription}\nType: ${activityType}\nDate: ${activityDate}\nLocation: ${activityLocation}`);
        activityForm.reset();
    });

    // 选项卡功能
    const tabs = document.querySelectorAll(".nav-link");
    const tabContents = document.querySelectorAll(".tab-pane");

    tabs.forEach((tab) => {
        tab.addEventListener("click", function () {
            tabs.forEach((t) => t.classList.remove("active"));
            tabContents.forEach((content) => content.classList.remove("show", "active"));

            tab.classList.add("active");
            const target = document.querySelector(tab.dataset.bsTarget);
            target.classList.add("show", "active");
        });
    });
});
