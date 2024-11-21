<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/jobBoard/styles/addUserStyles.css">
    <title>Invoice App</title>
</head>
<!-- TODO Create nav to navigate -->
<!-- Fix the Ai generated generic code -->

<body>
    <div class="container">
        <div class="form-header">
            <h1 class="title">Create an account</h1>
        </div>

        <form id="registrationForm" novalidate>
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" class="input-field" placeholder="Enter your full name" required>
                <span class="error-message">Please enter your full name</span>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" class="input-field" placeholder="Enter your email" required>
                <span class="error-message">Please enter a valid email address</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="input-field" placeholder="Create a password" required>
                <div class="password-requirements">
                    <div class="requirement" data-requirement="length">At least 8 characters long</div>
                    <div class="requirement" data-requirement="number">Contains at least one number</div>
                    <div class="requirement" data-requirement="special">Contains at least one special character</div>
                    <div class="requirement" data-requirement="case">Contains uppercase and lowercase letters</div>
                </div>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" class="input-field" placeholder="Confirm your password"
                    required>
                <span class="error-message">Passwords do not match</span>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="terms" required>
                <label for="terms">I agree to the Terms of Service and Privacy Policy</label>
            </div>

            <button type="submit" class="submit-button" disabled>Create Account</button>

            <div class="login-link">
                Already have an account? <a href="#">Log in</a>
            </div>
        </form>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('registrationForm');
            const fullnameInput = document.getElementById('fullname');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            const termsCheckbox = document.getElementById('terms');
            const submitButton = form.querySelector('.submit-button');
            const toast = document.getElementById('toast');

            // Password requirements
            const requirements = {
                length: password => password.length >= 8,
                number: password => /\d/.test(password),
                special: password => /[!@#$%^&*(),.?":{}|<>]/.test(password),
                case: password => /[a-z]/.test(password) && /[A-Z]/.test(password)
            };

            // Validate full name
            function validateFullName() {
                const isValid = fullnameInput.value.trim().length >= 2;
                toggleError(fullnameInput, isValid);
                return isValid;
            }

            // Validate email
            function validateEmail() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const isValid = emailRegex.test(emailInput.value);
                toggleError(emailInput, isValid);
                return isValid;
            }

            // Validate password
            function validatePassword() {
                const password = passwordInput.value;
                let isValid = true;

                // Check each requirement
                Object.entries(requirements).forEach(([key, validator]) => {
                    const requirementElement = document.querySelector(`[data-requirement="${key}"]`);
                    const isRequirementMet = validator(password);
                    requirementElement.classList.toggle('valid', isRequirementMet);
                    isValid = isValid && isRequirementMet;
                });

                toggleError(passwordInput, isValid);
                return isValid;
            }

            // Validate confirm password
            function validateConfirmPassword() {
                const isValid = confirmPasswordInput.value === passwordInput.value;
                toggleError(confirmPasswordInput, isValid);
                return isValid;
            }

            // Toggle error state
            function toggleError(input, isValid) {
                input.classList.toggle('error', !isValid);
                input.classList.toggle('valid', isValid);
            }

            // Check if form is valid
            function checkFormValidity() {
                const isValid = validateFullName() &&
                    validateEmail() &&
                    validatePassword() &&
                    validateConfirmPassword() &&
                    termsCheckbox.checked;

                submitButton.disabled = !isValid;
            }

            // Show toast message
            function showToast(message, type = 'success') {
                toast.textContent = message;
                toast.className = `toast ${type} show`;

                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }

            // Event listeners for real-time validation
            fullnameInput.addEventListener('input', () => {
                validateFullName();
                checkFormValidity();
            });

            emailInput.addEventListener('input', () => {
                validateEmail();
                checkFormValidity();
            });

            passwordInput.addEventListener('input', () => {
                validatePassword();
                validateConfirmPassword();
                checkFormValidity();
            });

            confirmPasswordInput.addEventListener('input', () => {
                validateConfirmPassword();
                checkFormValidity();
            });

            termsCheckbox.addEventListener('change', checkFormValidity);

            // Form submission
            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                if (!submitButton.disabled) {
                    try {
                        // Simulate API call
                        await new Promise(resolve => setTimeout(resolve, 1000));

                        // Create user object
                        const userData = {
                            fullName: fullnameInput.value,
                            email: emailInput.value,
                            password: passwordInput.value
                        };

                        console.log('Registration successful:', userData);
                        showToast('Registration successful! Please check your email to verify your account.');

                        // Reset form
                        form.reset();
                        document.querySelectorAll('.requirement').forEach(req => req.classList.remove('valid'));
                        document.querySelectorAll('.input-field').forEach(input => {
                            input.classList.remove('valid', 'error');
                        });
                        submitButton.disabled = true;

                    } catch (error) {
                        console.error('Registration failed:', error);
                        showToast('Registration failed. Please try again.', 'error');
                    }
                }
            });
        });
    </script>
</body>

</html>