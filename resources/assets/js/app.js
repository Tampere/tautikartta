
require('./bootstrap');

const modal = document.getElementById("modal");
const btnOpen = document.getElementById("openInfo");
const btnClose = document.getElementById("closeBtn");

btnOpen.onmousedown = function() {
    modal.style.display = "block";
    window.location.hash = "info";
};

btnClose.onmousedown = function() {
    modal.style.display = "none";
};

window.addEventListener('statechange', function(event) {
    console.log("statechange");
    console.log(window.location.hash);
});

window.addEventListener("popstate", function(event) {
    console.log("popstate");
    console.log(window.location.hash);
    if(window.location.hash != "#info") {
        modal.style.display = "none";
    }
}, false);
window.history.pushState({}, "", window.location.toString());
