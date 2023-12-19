const button = document.getElementById('loginSubmit');
button.addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('logout-form').submit();
});
