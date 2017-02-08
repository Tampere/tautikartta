
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const modal = document.getElementById("modal");
const btnOpen = document.getElementById("openInfo");
const btnClose = document.getElementById("closeBtn");

btnOpen.onclick = function() {
    modal.style.display = "block";
};

btnClose.onclick = function() {
    modal.style.display = "none";
};

/*
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
*/
