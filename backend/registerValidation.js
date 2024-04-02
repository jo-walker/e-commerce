document.addEventListener('DOMContentLoaded', () => {
    const signForm = document.querySelector('#registrationForm');
    
    const submitHandler = (event) => {
        event.preventDefault(); // Prevent the form from submittin.

        // Clear error messages
        resetErrorMessages();

        let formValid = true;
        let allFieldsFilled = true;

        // Check all inputs fields for a data.
        const inputs = signForm.querySelectorAll('input[type="text"], input[type="password"], input[type="email"]');
        inputs.forEach(input => {
            if (!input.value.trim()) {
                allFieldsFilled = false;
                showError(input, 'This field is required.');
            }
        });

        if (!allFieldsFilled) {
            formValid = false;
            alert('All fields are required :) '); 
        }

        
        if (allFieldsFilled) {

            const nameInput = document.getElementById('name');
            if (nameInput.value.trim().length < 5 || nameInput.value.trim().length > 30) {
                showError(nameInput, 'Name must be between 5 and 30 characters.');
                formValid = false;
            }

            const emailInput = document.getElementById('email');
            if (!emailIsValid(emailInput.value.trim())) {
                showError(emailInput, 'Enter a valid email.');
                formValid = false;
            }

            const pwdInput = document.getElementById('password');
            if (pwdInput.value.length < 8) {
                showError(pwdInput, 'Password needs at least 8 characters.');
                formValid = false;
            }

            const confirmPwdInput = document.getElementById('confirm-password');
            if (pwdInput.value !== confirmPwdInput.value || confirmPwdInput.value.trim() === '') {
                showError(confirmPwdInput, 'Passwords must match.');
                formValid = false;
            }
        }

        if (!formValid) return false; // Block form submission if invalid.

        signForm.submit(); // Proceed with submission if valid.
    };

    signForm.addEventListener('submit', submitHandler);

    function showError(input, msg) {
        let container = input.closest('.input-group');
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