
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

window.addEventListener("popstate", function(event) {
    if(window.location.hash != "#info") {
        modal.style.display = "none";
    }
});
