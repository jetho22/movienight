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
