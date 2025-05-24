document.addEventListener('DOMContentLoaded', function() {
    // Hap modalin kryesor kur klikohet "Sign in"
    document.querySelector('.signup-btn').addEventListener('click', function() {
        document.getElementById('modal1').style.display = 'flex';
    });

    // Mbylle modalin kryesor
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('modal1').style.display = 'none';
    });

    // Hap modalin e regjistrimit
    document.getElementById('openCreateAccount').addEventListener('click', function() {
        document.getElementById('modal1').style.display = 'none';
        document.getElementById('createAccountModal').style.display = 'flex';
    });

    // Mbylle modalin e regjistrimit
    document.getElementById('closeCreateAccount').addEventListener('click', function() {
        document.getElementById('createAccountModal').style.display = 'none';
    });

    // Hap modalin e login-it
    document.getElementById('openLogin').addEventListener('click', function() {
        document.getElementById('modal1').style.display = 'none';
        document.getElementById('loginModal').style.display = 'flex';
    });

    // Mbylle modalin e login-it
    document.getElementById('closeLogin').addEventListener('click', function() {
        document.getElementById('loginModal').style.display = 'none';
    });

    // Toggle password visibility
    function togglePasswordVisibility() {
        console.log("Toggle password visibility called");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("confirmPassword");
        if (passwordInput && confirmPasswordInput) {
            const newType = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = newType;
            confirmPasswordInput.type = newType;
        }
    }

    // Check password match
    function checkPasswordMatch() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        if (password !== confirmPassword) {
            document.getElementById("confirmPassword").setCustomValidity("Passwords do not match");
        } else {
            document.getElementById("confirmPassword").setCustomValidity("");
        }
    }

    // Add event listener to the show password checkbox
    const showPasswordCheckbox = document.getElementById("showPassword");
    if (showPasswordCheckbox) {
        showPasswordCheckbox.addEventListener("change", togglePasswordVisibility);
    }
});