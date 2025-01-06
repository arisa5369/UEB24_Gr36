const modal1 = document.getElementById("modal1");
const signUpButton = document.querySelector(".signup-btn");
const closeModal = document.getElementById("closeModal");

const createAccountModal = document.getElementById("createAccountModal");
const openCreateAccount = document.getElementById("openCreateAccount");
const closeCreateAccount = document.getElementById("closeCreateAccount");

const loginModal = document.getElementById("loginModal");
const openLogin = document.getElementById("openLogin");
const closeLogin = document.getElementById("closeLogin");

signUpButton.addEventListener("click", () => {
  modal1.style.display = "flex";
});

closeModal.addEventListener("click", () => {
  modal1.style.display = "none";
});

openCreateAccount.addEventListener("click", () => {
  modal1.style.display = "none"; 
  createAccountModal.style.display = "flex";
});

closeCreateAccount.addEventListener("click", () => {
  createAccountModal.style.display = "none";
});

openLogin.addEventListener("click", () => {
  modal1.style.display = "none"; 
  loginModal.style.display = "flex";
});

closeLogin.addEventListener("click", () => {
  loginModal.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === modal1) {
    modal1.style.display = "none";
  } else if (event.target === createAccountModal) {
    createAccountModal.style.display = "none";
  } else if (event.target === loginModal) {
    loginModal.style.display = "none";
  }
});