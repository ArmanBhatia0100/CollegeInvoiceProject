<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/InvoiceProject/styles/addUserStyles.css">
    <title>Invoice App</title>
</head>
<!--TODO Add the search and filter functions -->

<body>
    <div class="container">
        <?php
        include "./header.php";
        ?>
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

    <script src="./../javascript/addUser.js"></script>
</body>

</html>