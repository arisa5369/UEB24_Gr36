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
    amountButtons.forEach((btn) => {
      btn.style.backgroundColor = '#fff';
      btn.style.color = '#333';
    });
    updateDonateButton();
  }
});

function updateDonateButton() {
  if (selectedAmount) {
    donateButton.textContent = `Donate ${selectedAmount} ${selectedFrequency}`;
  } else {
    donateButton.textContent = 'Donate♡';
  }
}

donateButton.addEventListener('click', () => {
  if (selectedAmount) {
    modal.style.display = "block";
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
document.querySelector('.sign-in-button').addEventListener('click', function () {
  this.textContent = 'Email for more info';
  this.style.background = '#4b4b4b'; 
  this.style.color = '#fff'; 
});