document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility for login
    function togglePasswordVisibility(fieldId, labelId) {
        const input = document.getElementById(fieldId);
        const label = document.getElementById(labelId);
        if (input && label) {
            const newType = input.type === "password" ? "text" : "password";
            input.type = newType;
            label.textContent = newType === "text" ? "Hide password" : "Show password";
        }
    }

    // Open login modal
    const openLogin = document.getElementById('openLogin');
    if (openLogin) {
        openLogin.addEventListener('click', function() {
            const modal1 = document.getElementById('modal1');
            const loginModal = document.getElementById('loginModal');
            if (modal1 && loginModal) {
                modal1.style.display = 'none';
                loginModal.style.display = 'flex';
            }
        });
    }

    // Close login modal
    const closeLogin = document.getElementById('closeLogin');
    if (closeLogin) {
        closeLogin.addEventListener('click', function() {
            const loginModal = document.getElementById('loginModal');
            if (loginModal) {
                loginModal.style.display = 'none';
            }
        });
    }

    // Open forgot password modal
    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    if (forgotPasswordLink) {
        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            const loginModal = document.getElementById('loginModal');
            const forgotPasswordModal = document.getElementById('forgotPasswordModal');
            if (loginModal && forgotPasswordModal) {
                loginModal.style.display = 'none';
                forgotPasswordModal.style.display = 'flex';
            }
        });
    }

    // Close forgot password modal
    const closeForgotPassword = document.getElementById('closeForgotPassword');
    if (closeForgotPassword) {
        closeForgotPassword.addEventListener('click', function() {
            const forgotPasswordModal = document.getElementById('forgotPasswordModal');
            if (forgotPasswordModal) {
                forgotPasswordModal.style.display = 'none';
            }
        });
    }

    // Open verify code modal after email submission (triggered by URL parameter)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'Verification_code_sent!') {
        const forgotPasswordModal = document.getElementById('forgotPasswordModal');
        const verifyCodeModal = document.getElementById('verifyCodeModal');
        if (forgotPasswordModal && verifyCodeModal) {
            forgotPasswordModal.style.display = 'none';
            verifyCodeModal.style.display = 'flex';
        }
    }

    // Close verify code modal
    const closeVerifyCode = document.getElementById('closeVerifyCode');
    if (closeVerifyCode) {
        closeVerifyCode.addEventListener('click', function() {
            const verifyCodeModal = document.getElementById('verifyCodeModal');
            if (verifyCodeModal) {
                verifyCodeModal.style.display = 'none';
            }
        });
    }

    // Password visibility toggle for reset password
    const showPasswordCheckbox = document.getElementById('showPassword');
    if (showPasswordCheckbox) {
        showPasswordCheckbox.addEventListener('change', function() {
            togglePasswordVisibility('new-password', 'showPasswordLabel');
            togglePasswordVisibility('confirm-new-password', 'showPasswordLabel');
        });
    }
});