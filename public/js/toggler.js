document.addEventListener("DOMContentLoaded", function () {
    const toggler = document.getElementById("navbarToggler");
    const navbar = document.getElementById("navbarNav");

    toggler.addEventListener("click", function () {

        const isExpanded = toggler.getAttribute("aria-expanded") === "true";
        toggler.setAttribute("aria-expanded", !isExpanded);

        navbar.classList.toggle("show");
    });
});
