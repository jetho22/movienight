// admin.js
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.deleteButton');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const userId = this.dataset.userId;
            const movieId = this.dataset.movieId;
            removeMovie(userId, movieId, this);
        });
    });
});

function removeMovie(userId, movieId, button) {
    fetch(`/admin/watchlists/${userId}/movies/${movieId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.documentElement.dataset.csrfToken,
        }
    })
        .then(response => {
            if (response.ok) {
                console.log('Movie successfully deleted');
                button.closest('li').remove();
            } else {
                console.error('Failed to delete due to server error');
                response.text().then(text => console.error('Failed to delete:', text));
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}





