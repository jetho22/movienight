const csrfToken = document.documentElement.dataset.csrfToken;
document.addEventListener('DOMContentLoaded', function () {
    // Select all buttons with the class 'watchedButton'
    const watchedButtons = document.querySelectorAll('.watchedButton');

    // Add a click event listener to each button
    watchedButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get the movie ID from the data attribute
            const movieId = this.getAttribute('data-movie-id');

            // Call the updateWatched function with the movie ID and the button
            updateWatched(movieId, this);
        });
    });
});

function updateWatched(movieId, button) {
    // Data to be sent in the request body
    const postData = {
        movieId: movieId,
    };

    console.log("Button clicked!")
    console.log(postData)

    // Make the API request using fetch
    fetch(`/updateWatched`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(postData),
    })
        .then(response => {
            console.log('Response Status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            if (button.classList.contains('watched')) {
                button.classList.remove('watched');
            } else {
                button.classList.add('watched');
            }
            // Handle the response as needed
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors
        });
}
