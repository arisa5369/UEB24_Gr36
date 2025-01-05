document.querySelector('.signup-btn').addEventListener('click', function() {
    document.getElementById('auth-modal').style.display = 'flex';
});

// Mbyll modal kur klikoni jashtë tij
window.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal')) {
        document.getElementById('auth-modal').style.display = 'none';
    }
});


