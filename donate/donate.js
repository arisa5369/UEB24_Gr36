const monthlyButton = document.querySelector('.donation-buttons button:nth-child(1)');
const oneTimeButton = document.querySelector('.donation-buttons button:nth-child(2)');
const amountButtons = document.querySelectorAll('.amount-options button');
const customAmountInput = document.querySelector('.custom-amount');
const donateButton = document.querySelector('.donate-button');
const modal = document.getElementById("donation-modal");
const closeDonationButton = document.querySelector(".close-donation-button");
const closeButton = document.querySelector(".close-button");

let selectedFrequency = 'One Time'; 
let selectedAmount = '';
let numericAmount = 0;

// Funksioni për dërgimin e të dhënave në server
async function sendDonationData() {
    // Krijo objektin me të dhënat e donacionit
    const formData = {
        'donation-type': selectedFrequency,
        'amount': numericAmount,
        'donor-name': '', // Mund të shtoni fushë për emër në HTML nëse është e nevojshme
        'donor-email': '' // Mund të shtoni fushë për email në HTML nëse është e nevojshme
    };
 console.log('Dërgoj këto të dhëna:', formData);
    try {
        const response = await fetch('process_donate.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(formData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            console.log('Donacioni u ruajt me sukses:', result.message);
            // Shfaq modalin pas ruajtjes së suksesshme
            modal.style.display = "block";
        } else {
            console.error('Gabim:', result.message);
            alert('Gabim: ' + result.message);
        }
    } catch (error) {
        console.error('Gabim në lidhje me serverin:', error);
        alert('Gabim në lidhje me serverin');
    }
}

// Kodi ekzistues i butonave
monthlyButton.addEventListener('click', () => {
    selectedFrequency = 'Monthly';
    monthlyButton.style.backgroundColor = '#ff7a00';
    monthlyButton.style.color = '#fff';
    oneTimeButton.style.backgroundColor = '#fff';
    oneTimeButton.style.color = '#333';
    updateDonateButton();
});

oneTimeButton.addEventListener('click', () => {
    selectedFrequency = 'One Time';
    oneTimeButton.style.backgroundColor = '#ff7a00';
    oneTimeButton.style.color = '#fff';
    monthlyButton.style.backgroundColor = '#fff';
    monthlyButton.style.color = '#333';
    updateDonateButton();
});

amountButtons.forEach((button) => {
    button.addEventListener('click', () => {
        selectedAmount = button.textContent;
        numericAmount = parseFloat(button.textContent.replace('$', ''));
        amountButtons.forEach((btn) => {
            btn.style.backgroundColor = '#fff';
            btn.style.color = '#333';
        });
        button.style.backgroundColor = '#ff7a00';
        button.style.color = '#fff';
        customAmountInput.value = '';
        updateDonateButton();
    });
});

customAmountInput.addEventListener('input', () => {
    const value = customAmountInput.value.replace(/[^0-9]/g, '');
    customAmountInput.value = value;
    if (value) {
        selectedAmount = `$${value}`;
        numericAmount = parseFloat(value);
        amountButtons.forEach((btn) => {
            btn.style.backgroundColor = '#fff';
            btn.style.color = '#333';
        });
        updateDonateButton();
    } else {
        selectedAmount = '';
        numericAmount = 0;
        updateDonateButton();
    }
});

function updateDonateButton() {
    if (selectedAmount) {
        donateButton.textContent = `Donate ${selectedAmount} ${selectedFrequency}`;
        donateButton.disabled = false;
    } else {
        donateButton.textContent = 'Donate♡';
        donateButton.disabled = true;
    }
}

donateButton.addEventListener('click', () => {
    if (selectedAmount) {
        sendDonationData();
    } else {
        alert('Please select an amount to donate.');
    }
});

closeDonationButton.addEventListener('click', () => {
    modal.style.display = "none";
});

closeButton.addEventListener('click', () => {
    modal.style.display = "none";
});

window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});