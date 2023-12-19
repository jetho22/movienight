
// Get the input elements and the submit button
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const submitButton = document.getElementById('submit-button');

// Function to enable/disable the submit button based on input values
function toggleSubmitButton() {
    const emailValue = emailInput.value.trim();
    const passwordValue = passwordInput.value.trim();
    submitButton.disabled = emailValue === '' || passwordValue === '';
}

// Add input event listeners to trigger the function on input changes
emailInput.addEventListener('input', toggleSubmitButton);
passwordInput.addEventListener('input', toggleSubmitButton);
