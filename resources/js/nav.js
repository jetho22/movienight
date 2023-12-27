const button = document.getElementById('loginSubmit');
button.addEventListener('click', function (event) {
    event.preventDefault();
    const currentLocale = window.location.pathname.split('/')[1];
    const logout = `/logout/${currentLocale}`;
    document.getElementById('logout-form').action = logout;
    document.getElementById('logout-form').submit();
});
