document.addEventListener('DOMContentLoaded', () => {
    const signForm = document.querySelector('#registrationForm');

    signForm.addEventListener('submit', (event) => {
        event.preventDefault();
        resetErrorMessages();

        if (!validateForm()) {
            console.log('Form is invalid.');
        } else {
            console.log('Form is valid. Form would be submitted here.');
            signForm.submit();
        }
    });

    function validateForm() {
        let isValid = true;

        isValid &= validateName();
        isValid &= validateEmail();
        isValid &= validatePassword();
        isValid &= validateConfirmPassword();

        return isValid;
    }

    function validateName() {
        const nameInput = document.getElementById('name');
        if (nameInput.value.trim() === '') {
            showError(nameInput, 'Name is required.');
            return false;
        } else if (nameInput.value.trim().length < 5 || nameInput.value.trim().length > 30) {
            showError(nameInput, 'Name must be between 5 and 30 characters.');
            return false;
        }
        return true;
    }

    function validateEmail() {
        const emailInput = document.getElementById('email');
        if (!emailIsValid(emailInput.value.trim())) {
            showError(emailInput, 'Enter a valid email.');
            return false;
        }
        return true;
    }

    function validatePassword() {
        const pwdInput = document.getElementById('password');
        if (pwdInput.value.length < 8) {
            showError(pwdInput, 'Password needs at least 8 characters.');
            return false;
        }
        return true;
    }

    function validateConfirmPassword() {
        const pwdInput = document.getElementById('password');
        const confirmPwdInput = document.getElementById('confirm-password');
        if (pwdInput.value !== confirmPwdInput.value) {
            showError(confirmPwdInput, 'Passwords must match.');
            return false;
        }
        return true;
    }

    function showError(input, msg) {
        console.log('showError called for', input.id, 'with message:', msg); // Debug line
        let container = input.closest('.input-group');
        console.log('Container found:', container); // Debug line
        let error = container.querySelector('.error');
        if (!error) {
            error = document.createElement('div');
            error.className = 'error';
            container.appendChild(error);
        }
        error.innerText = msg;
        error.style.color = 'red';
    }
    

    function resetErrorMessages() {
        document.querySelectorAll('.error').forEach(error => error.remove());
    }

    function removeError(input) {
        let container = input.closest('.input-group');
        let error = container.querySelector('.error');
        if (error) {
            error.remove();
        }
    }

    function emailIsValid(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
});