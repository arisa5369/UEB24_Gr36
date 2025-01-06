const modal = document.getElementById("modal");
const signUpButton = document.querySelector(".signup-btn");
const closeModal = document.getElementById("closeModal");

const createAccountModal = document.getElementById("createAccountModal");
const openCreateAccount = document.getElementById("openCreateAccount");
const closeCreateAccount = document.getElementById("closeCreateAccount");

const loginModal = document.getElementById("loginModal");
const openLogin = document.getElementById("openLogin");
const closeLogin = document.getElementById("closeLogin");

signUpButton.addEventListener("click", () => {
  modal.style.display = "flex";
});

closeModal.addEventListener("click", () => {
  modal.style.display = "none";
});

openCreateAccount.addEventListener("click", () => {
  modal.style.display = "none"; 
  createAccountModal.style.display = "flex";
});
closeCreateAccount.addEventListener("click", () => {
  createAccountModal.style.display = "none";
});

openLogin.addEventListener("click", () => {
  modal.style.display = "none"; 
  loginModal.style.display = "flex";
});

closeLogin.addEventListener("click", () => {
  loginModal.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.style.display = "none";
  } else if (event.target === createAccountModal) {
    createAccountModal.style.display = "none";
  } else if (event.target === loginModal) {
    loginModal.style.display = "none";
  }
});