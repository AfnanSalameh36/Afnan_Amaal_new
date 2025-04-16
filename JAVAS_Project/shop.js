document.addEventListener("DOMContentLoaded", function () {
    const sortByBtn = document.querySelector('.menu-button:last-child');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    sortByBtn.addEventListener('click', function (e) {
        e.preventDefault(); // prevent jumping to top
        dropdownMenu.classList.toggle('show-dropdown');
    });
});

