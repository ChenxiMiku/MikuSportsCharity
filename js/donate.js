
function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

window.onload = function () {
    const charityName = getUrlParameter('charityName');
    const eventName = getUrlParameter('eventName');
    const raisedAmount = getUrlParameter('raisedAmount');
    const goalAmount = getUrlParameter('goalAmount');
    const eventImage = getUrlParameter('eventImage');

    document.getElementById('charity-name').textContent = charityName;
    document.getElementById('event-name').textContent = eventName;
    document.getElementById('event-raised').textContent = raisedAmount;
    document.getElementById('event-goal').textContent = goalAmount;
    document.getElementById('event-image').src = eventImage;

};
