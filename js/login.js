
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const loginButton = document.getElementById('loginButton');

emailInput.addEventListener('input', toggleLoginButton);
passwordInput.addEventListener('input', toggleLoginButton);

function toggleLoginButton() {
    if (emailInput.value.trim() === '' || passwordInput.value.trim() === '') {
        loginButton.disabled = true;
        loginButton.style.backgroundColor = '#5f5f5f';
        loginButton.style.cursor = 'no-drop';
    } else {
        loginButton.disabled = false;
        loginButton.style.cursor = 'pointer';
        loginButton.style.backgroundColor = '#4b8f44';
    }
}