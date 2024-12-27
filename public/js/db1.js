document.addEventListener("DOMContentLoaded", function () {
    const activityType = document.getElementById("activityType");
    const donationFields = document.getElementById("donationFields");
    const volunteerFields = document.getElementById("volunteerFields");

    // 动态显示字段
    activityType.addEventListener("change", function () {
        if (activityType.value === "donation") {
            donationFields.classList.remove("d-none");
            volunteerFields.classList.add("d-none");
        } else if (activityType.value === "volunteer") {
            donationFields.classList.add("d-none");
            volunteerFields.classList.remove("d-none");
        } else {
            donationFields.classList.add("d-none");
            volunteerFields.classList.add("d-none");
        }
    });

    const activityForm = document.getElementById("publishActivityForm");
    activityForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const activityTitle = document.getElementById("activityTitle").value.trim();
        const activityDescription = document.getElementById("activityDescription").value.trim();
        const activityTypeValue = activityType.value.trim();
        const activityDate = document.getElementById("activityDate").value.trim();
        const activityLocation = document.getElementById("activityLocation").value.trim();
        const activityImage = document.getElementById("activityImage").files[0];
        
        if (!activityTitle || !activityDescription || !activityTypeValue || !activityDate || !activityLocation || !activityImage) {
            alert("Please fill in all fields.");
            return;
        }

        if (activityTypeValue === "donation") {
            const charityName = document.getElementById("charityName").value.trim();
            const fundingGoal = document.getElementById("fundingGoal").value.trim();

            if (!charityName || !fundingGoal) {
                alert("Please fill in all donation-specific fields.");
                return;
            }

            alert(`Activity published successfully:\nTitle: ${activityTitle}\nDescription: ${activityDescription}\nType: ${activityTypeValue}\nDate: ${activityDate}\nLocation: ${activityLocation}\nCharity: ${charityName}\nFunding Goal: ${fundingGoal}`);
        } else if (activityTypeValue === "volunteer") {
            const eventDate = document.getElementById("eventDate").value.trim();
            const eventLocation = document.getElementById("eventLocation").value.trim();
            const charityId = document.getElementById("charityId").value.trim();
            const imagePath = document.getElementById("imagePath").value.trim();
            const volunteerGoal = document.getElementById("volunteerGoal").value.trim();

            if (!eventDate || !eventLocation || !charityId || !imagePath || !volunteerGoal) {
                alert("Please fill in all volunteer-specific fields.");
                return;
            }

            alert(`Activity published successfully:\nTitle: ${activityTitle}\nDescription: ${activityDescription}\nType: ${activityTypeValue}\nDate: ${activityDate}\nLocation: ${activityLocation}\nEvent Date: ${eventDate}\nEvent Location: ${eventLocation}\nCharity ID: ${charityId}\nImage Path: ${imagePath}\nVolunteer Goal: ${volunteerGoal}`);
        }

        activityForm.reset();
        donationFields.style.display = "none"; // 隐藏 donation-specific 字段
        volunteerFields.style.display = "none"; // 隐藏 volunteer-specific 字段
    });
});
