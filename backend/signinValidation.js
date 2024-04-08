document.addEventListener('DOMContentLoaded', () => {
    const signInForm = document.querySelector('.signForm');

    const userNameInput = document.getElementById('name');
    const passwordInput = document.getElementById('password');

    // To remove error
    function clearError(input) {
        const container = input.parentElement;
        const error = container.querySelector('.error-message');
        if (error) {
            error.textContent = ''; 
        }
    }

    // Event listeners for inputs
    [userNameInput, passwordInput].forEach(input => {
        input.addEventListener('input', () => {
            clearError(input);
        });
    });

    const submitHandler = (event) => {
        event.preventDefault(); // Prevent the form from submitting 

        resetErrorMessages();

        let formValid = true;

        // Validate User Name
        if (!userNameInput.value.trim()) {
            showError(userNameInput, 'User Name is required.');
            formValid = false;
        }

        // Validate Password
        if (!passwordInput.value.trim()) {
            showError(passwordInput, 'Password is required.');
            formValid = false;
        }

       if (!formValid) {
            return false;
       }

       event.target.submit();
    };

    signInForm.addEventListener('submit', submitHandler);
});
    
function showError(input, message) {
    const container = input.parentElement;
    let error = container.querySelector('.error-message');
    if (!error) {
        error = document.createElement('span');
        error.className = 'error-message';
        container.appendChild(error);
    }
    error.textContent = message;
   error.style.color='red';
}

function resetErrorMessages() {
    document.querySelectorAll('.error-message').forEach(error => {
        error.textContent = ''; // Clear the error message
    });
}