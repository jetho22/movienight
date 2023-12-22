import './bootstrap';

const csrfToken = document.documentElement.dataset.csrfToken;

document.addEventListener('DOMContentLoaded', function () {
    const addButtonElements = document.querySelectorAll('.addButton');

    addButtonElements.forEach(button => {
        button.addEventListener('click', function(event) {
            // Prevent the default button behavior (form submission)
            event.preventDefault();

            // Get the movie ID and other data from the data attributes
            const movieId = button.getAttribute('data-movie-id');
            const voteAverage = button.getAttribute('data-vote-average');
            const title = button.getAttribute('data-title');
            const releaseDate = button.getAttribute('data-release-date');
            const posterPath = button.getAttribute('data-poster-path');

            add(movieId, voteAverage, title, releaseDate, posterPath, this);
        });
    });
});

function add(movieId, voteAverage, title, releaseDate, posterPath, button) {
    // Create an object to hold the data
    const data = {
        movieId: movieId,
        voteAverage: voteAverage,
        title: title,
        releaseDate: releaseDate,
        posterPath: posterPath
    };

    console.log(data)

    // Perform an AJAX request to handle the "Add" action
    fetch(`/create`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data), // Send the data object
    })
        .then(response => response.json())
        .then(data => {
            // Handle the response data, e.g., display a success message
            button.classList.add('added');
            button.disabled = true;
            console.log(data.message);
        })
        .catch(error => {
            // Handle any errors
            console.error(error);
        });
}

document.querySelector('.searchForm').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // Prevents the default form submission
        document.getElementById('searchForm').submit(); // Manually submit the form
    }
});

document.querySelector('.searchForm').addEventListener('submit', function (event) {
    const searchForm = document.getElementById('searchForm');

    searchForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(searchForm);

        // Make the AJAX request using the Fetch API
    fetch('/search', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest', // Add this header for Laravel to recognize AJAX requests
        },
        body: formData,
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function (data) {
            // Handle the success response, update the view, etc.
            console.log('Ajax request successful', data);
        })
        .catch(function (error) {
            // Handle errors
            console.error('Ajax request failed:', error);
        });
    });
});
