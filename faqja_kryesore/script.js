document.addEventListener('DOMContentLoaded', function() {
    
    // Toggle password visibility
function togglePasswordVisibility() {
    console.log("Toggle password visibility called");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const showPasswordLabel = document.querySelector('label[for="showPassword"]');
    if (passwordInput && confirmPasswordInput) {
        const newType = passwordInput.type === "password" ? "text" : "password";
        passwordInput.type = newType;
        confirmPasswordInput.type = newType;
        showPasswordLabel.textContent = newType === "text" ? "Hide password" : "Show password";
    } else {
        console.error("Password or Confirm Password input not found");
    }
}

// Check password match
function checkPasswordMatch() {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    if (passwordInput && confirmPasswordInput) {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        if (password !== confirmPassword) {
            confirmPasswordInput.setCustomValidity("Passwords do not match");
        } else {
            confirmPasswordInput.setCustomValidity("");
        }
    } else {
        console.error("Password or Confirm Password input not found for validation");
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Event listeners...
    document.getElementById('openCreateAccount').addEventListener('click', function() {
        console.log("Opening Create Account modal");
        document.getElementById('modal1').style.display = 'none';
        document.getElementById('createAccountModal').style.display = 'flex';

        const showPasswordCheckbox = document.getElementById("showPassword");
        if (showPasswordCheckbox) {
            showPasswordCheckbox.removeEventListener("change", togglePasswordVisibility);
            showPasswordCheckbox.addEventListener("change", togglePasswordVisibility);
            console.log("Event listener attached to showPassword checkbox");
        } else {
            console.error("Show Password checkbox not found");
        }

        const confirmPasswordInput = document.getElementById("confirmPassword");
        if (confirmPasswordInput) {
            confirmPasswordInput.removeEventListener("input", checkPasswordMatch);
            confirmPasswordInput.addEventListener("input", checkPasswordMatch);
        }
    });
    // Other event listeners...
});
    
    // Hap modalin kryesor kur klikohet "Sign in"
    const signupBtn = document.querySelector('.signup-btn');
    if (signupBtn) {
        signupBtn.addEventListener('click', function() {
            const modal1 = document.getElementById('modal1');
            if (modal1) {
                modal1.style.display = 'flex';
            } else {
                console.error('Modal1 not found');
            }
        });
    } else {
        console.error('Signup button not found');
    }

    // Mbylle modalin kryesor
    const closeModal = document.getElementById('closeModal');
    if (closeModal) {
        closeModal.addEventListener('click', function() {
            const modal1 = document.getElementById('modal1');
            if (modal1) {
                modal1.style.display = 'none';
            }
        });
    }


    // Hap modalin e regjistrimit dhe attach event listeners
    const openCreateAccount = document.getElementById('openCreateAccount');
    if (openCreateAccount) {
        openCreateAccount.addEventListener('click', function() {
            const modal1 = document.getElementById('modal1');
            const createAccountModal = document.getElementById('createAccountModal');
            if (modal1 && createAccountModal) {
                modal1.style.display = 'none';
                createAccountModal.style.display = 'flex';

                // Attach event listeners after the modal is opened
                const showPasswordCheckbox = document.getElementById("showPassword");
                if (showPasswordCheckbox) {
                    showPasswordCheckbox.removeEventListener("change", togglePasswordVisibility);
                    showPasswordCheckbox.addEventListener("change", togglePasswordVisibility);
                } else {
                    console.error("Show Password checkbox not found");
                }

                const confirmPasswordInput = document.getElementById("confirmPassword");
                if (confirmPasswordInput) {
                    confirmPasswordInput.removeEventListener("input", checkPasswordMatch);
                    confirmPasswordInput.addEventListener("input", checkPasswordMatch);
                }
            } else {
                console.error('Modal1 or CreateAccountModal not found');
            }
        });
    } else {
        console.error('Open Create Account button not found');
    }

    // Mbylle modalin e regjistrimit
    const closeCreateAccount = document.getElementById('closeCreateAccount');
    if (closeCreateAccount) {
        closeCreateAccount.addEventListener('click', function() {
            const createAccountModal = document.getElementById('createAccountModal');
            if (createAccountModal) {
                createAccountModal.style.display = 'none';
            }
        });
    }

    // Hap modalin e login-it
    const openLogin = document.getElementById('openLogin');
    if (openLogin) {
        openLogin.addEventListener('click', function() {
            const modal1 = document.getElementById('modal1');
            const loginModal = document.getElementById('loginModal');
            if (modal1 && loginModal) {
                modal1.style.display = 'none';
                loginModal.style.display = 'flex';
            } else {
                console.error('Modal1 or LoginModal not found');
            }
        });
    } else {
        console.error('Open Login button not found');
    }

    // Mbylle modalin e login-it
    const closeLogin = document.getElementById('closeLogin');
    if (closeLogin) {
        closeLogin.addEventListener('click', function() {
            const loginModal = document.getElementById('loginModal');
            if (loginModal) {
                loginModal.style.display = 'none';
            }
        });
    }
});