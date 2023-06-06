
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const repasswordInput = document.getElementById('repassword');
const img = document.getElementById('mae_img');
const names = document.getElementById('name');
const signupButton = document.getElementById('signupButton');

emailInput.addEventListener('input', toggleSignupButton);
passwordInput.addEventListener('input', toggleSignupButton);
repasswordInput.addEventListener('input', toggleSignupButton);
img.addEventListener('input', toggleSignupButton);
names.addEventListener('input', toggleSignupButton);

function toggleSignupButton() {
    if (emailInput.value.trim() === '' || passwordInput.value.trim() === '' || repasswordInput.value.trim() === '' || img.value.trim() === '' || names.value.trim() === '') {
        signupButton.disabled = true;
        signupButton.style.backgroundColor = '#5f5f5f';
        signupButton.style.cursor = 'no-drop';
    } else {
        signupButton.disabled = false;
        signupButton.style.cursor = 'pointer';
        signupButton.style.backgroundColor = '#f3450f';
    }
}
