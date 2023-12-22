document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('loginSubmit');
    button.addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const searchButton = document.getElementById('searchItem');
    const searchContainer = document.querySelector('.search-bar-container');
    const searchBar = document.querySelector('.searchForm');

    const firstClickHandler = function (event) {
        console.log("search button clicked");
        event.preventDefault();
        event.stopPropagation();

        // Add an event listener for the next click
        document.addEventListener('click', handleClose, { once: true });

        // Add your toggle logic here (if needed)
        searchContainer.classList.toggle('active');
    };

    const handleClose = function (event) {
        const isClickInsideSearchBar = searchBar.contains(event.target);

        if (!isClickInsideSearchBar) {
            searchContainer.classList.remove('active');
            console.log("Clicked outside search bar")
        }
    }

    searchButton.addEventListener('click', firstClickHandler);
});
