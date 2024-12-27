document.addEventListener("DOMContentLoaded", function () {
    const timeSlotsContainer = document.getElementById("timeSlots");
    const addTimeSlotButton = document.getElementById("addTimeSlot");

    // 添加时间段
    addTimeSlotButton.addEventListener("click", function () {
        const timeSlot = document.createElement("div");
        timeSlot.className = "time-slot";
        timeSlot.innerHTML = `
        <small class="d-inline-block mx-2">Start time</small>
        <input type="time" class="form-control d-inline-block w-45 mb-3" required>
        <small class="d-inline-block mx-2">End time</small>
        <input type="time" class="form-control d-inline-block w-45 mb-3"required>
        <button type="button" class="btn btn-danger btn-sm " onclick="removeTimeSlot(this)">Remove</button>
        `;
        timeSlotsContainer.appendChild(timeSlot);
    });

    // 移除时间段
    window.removeTimeSlot = function (button) {
        button.parentElement.remove();
    };

    // 表单提交时验证时间段
    document.getElementById("publishActivityForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const timeSlots = Array.from(timeSlotsContainer.querySelectorAll(".time-slot"));
        const timeSlotData = [];

        for (const slot of timeSlots) {
            const [startTimeInput, endTimeInput] = slot.querySelectorAll("input");
            const startTime = startTimeInput.value.trim();
            const endTime = endTimeInput.value.trim();

            if (!startTime || !endTime) {
                alert("Please fill in all time slots.");
                return;
            }

            if (startTime >= endTime) {
                alert("End Time must be later than Start Time for all time slots.");
                return;
            }

            timeSlotData.push({ start_time: startTime, end_time: endTime });
        }

        console.log("Time Slots Data:", timeSlotData);

        // 其他表单字段获取与处理逻辑...
        alert("Form submitted successfully with time slots!");
    });
});
