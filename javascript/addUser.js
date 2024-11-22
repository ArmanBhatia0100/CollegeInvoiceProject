document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registrationForm");
  const fullnameInput = document.getElementById("fullname");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirm-password");
  const termsCheckbox = document.getElementById("terms");
  const submitButton = form.querySelector(".submit-button");
  const toast = document.getElementById("toast");

  // Password requirements
  const requirements = {
    length: (password) => password.length >= 8,
    number: (password) => /\d/.test(password),
    special: (password) => /[!@#$%^&*(),.?":{}|<>]/.test(password),
    case: (password) => /[a-z]/.test(password) && /[A-Z]/.test(password),
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

    Object.entries(requirements).forEach(([key, validator]) => {
      const requirementElement = document.querySelector(
        `[data-requirement="${key}"]`
      );
      const isRequirementMet = validator(password);
      requirementElement.classList.toggle("valid", isRequirementMet);
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
    input.classList.toggle("error", !isValid);
    input.classList.toggle("valid", isValid);
  }

  // Check if form is valid
  function checkFormValidity() {
    const isValid =
      validateFullName() &&
      validateEmail() &&
      validatePassword() &&
      validateConfirmPassword() &&
      termsCheckbox.checked;

    submitButton.disabled = !isValid;
  }

  // Show toast message
  function showToast(message, type = "success") {
    toast.textContent = message;
    toast.className = `toast ${type} show`;

    setTimeout(() => {
      toast.classList.remove("show");
    }, 3000);
  }

  // Event listeners for real-time validation
  fullnameInput.addEventListener("input", () => {
    validateFullName();
    checkFormValidity();
  });

  emailInput.addEventListener("input", () => {
    validateEmail();
    checkFormValidity();
  });

  passwordInput.addEventListener("input", () => {
    validatePassword();
    validateConfirmPassword();
    checkFormValidity();
  });

  confirmPasswordInput.addEventListener("input", () => {
    validateConfirmPassword();
    checkFormValidity();
  });

  termsCheckbox.addEventListener("change", checkFormValidity);

  // Form submission
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (!submitButton.disabled) {
      try {
        // Create user object
        const userData = {
          fullName: fullnameInput.value,
          email: emailInput.value,
          password: passwordInput.value,
        };

        // Send data to PHP
        const response = await fetch(
          "/InvoiceProject/php/FormSubmissions/save_user.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(userData),
          }
        );

        const result = await response.json();

        if (result.success) {
          showToast(
            "Registration successful! Please check your email to verify your account."
          );

          // Reset form
          form.reset();
          document
            .querySelectorAll(".requirement")
            .forEach((req) => req.classList.remove("valid"));
          document.querySelectorAll(".input-field").forEach((input) => {
            input.classList.remove("valid", "error");
          });
          submitButton.disabled = true;
        } else {
          throw new Error(result.message);
        }
      } catch (error) {
        console.error("Registration failed:", error);
        showToast(
          error.message || "Registration failed. Please try again.",
          "error"
        );
      }
    }
  });
});
