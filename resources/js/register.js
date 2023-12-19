// Get the input elements and the submit button
const nameInput = document.getElementById('name');
const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const submitButton = document.getElementById('submit-button');

// Function to enable/disable the submit button based on input values
function toggleSubmitButton() {
    const nameValue = nameInput.value.trim();
    const usernameValue = usernameInput.value.trim();
    const emailValue = emailInput.value.trim();
    const passwordValue = passwordInput.value.trim();
    submitButton.disabled = nameValue === '' || usernameValue === '' || emailValue === '' || passwordValue === '';

}

// Add input event listeners to trigger the function on input changes
nameInput.addEventListener('input', toggleSubmitButton)
usernameInput.addEventListener('input', toggleSubmitButton)
emailInput.addEventListener('input', toggleSubmitButton);
passwordInput.addEventListener('input', toggleSubmitButton);
