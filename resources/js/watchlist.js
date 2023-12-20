const csrfToken = document.documentElement.dataset.csrfToken;
document.addEventListener('DOMContentLoaded', function () {
    const watchedButtons = document.querySelectorAll('.watchedButton');
    const removeButtons = document.querySelectorAll('.removeButton');

    watchedButtons.forEach(button => {
        button.addEventListener('click', function () {
            const movieId = this.getAttribute('data-movie-id');
            updateWatched(movieId, this);
        });
    });

    removeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const movieId = this.getAttribute('data-movie-id');
            removeMovie(movieId, this);
        });
    });
});

function updateWatched(movieId, button) {

    const postData = {
        movieId: movieId,
    };

    console.log("Update button clicked!")
    console.log(postData)

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
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function removeMovie(movieId, button) {

    const postData = {
        movieId: movieId,
    };

    console.log("Remove button clicked!")
    console.log(postData)

    // Make the API request using fetch
    fetch(`/removeMovie`, {
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
            location.reload()
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
