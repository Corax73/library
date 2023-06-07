const btnRating = document.getElementById('btnRating');
const rating = document.getElementById('rating');

function activate() {
    btnRating.disabled = false;
}

/**
 * handle the event
 */
function starsHandler() {
    rating.addEventListener('click', activate);
}

/**
 * script initialization
 */
function init() {
    btnRating.disabled = true;
    starsHandler();
}

init();