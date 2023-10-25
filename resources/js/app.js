import './bootstrap';

function handleGenreClick(clickedButton) {
    const buttons = document.querySelectorAll('.genres button');

    // Remove the "active" class from all buttons
    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    // Add the "active" class to the clicked button
    clickedButton.classList.add('active');
}

window.handleGenreClick = handleGenreClick;
