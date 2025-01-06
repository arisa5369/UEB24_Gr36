  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute("href")).scrollIntoView({
        behavior: "smooth",
      });
    });
  });
  
 
  const faqDetails = document.querySelectorAll("details");
  faqDetails.forEach(detail => {
    detail.addEventListener("toggle", () => {
      if (detail.open) {
        detail.style.transition = "all 0.3s ease-in-out";
        detail.style.border = "1px solid #ff7f3f";
      } else {
        detail.style.border = "1px solid #ddd";
      }
    });
  });

  
  const donationButtons = document.querySelectorAll(".donation-grid button");
  donationButtons.forEach(button => {
    button.addEventListener("mouseover", () => {
      button.style.transform = "scale(1.1)";
      button.style.boxShadow = "0 4px 10px rgba(0, 0, 0, 0.2)";
    });
    button.addEventListener("mouseout", () => {
      button.style.transform = "scale(1)";
      button.style.boxShadow = "none";
    });
  });
  
  const testimonialImages = document.querySelectorAll(".testimonial-image img");
  testimonialImages.forEach(image => {
    image.addEventListener("mouseover", () => {
      image.style.transform = "rotate(5deg) scale(1.05)";
    });
    image.addEventListener("mouseout", () => {
      image.style.transform = "rotate(0deg) scale(1)";
    });
  });

const fosterImages = document.querySelectorAll(".images img");

fosterImages.forEach(img => {
  img.addEventListener("mouseover", () => {
    img.style.transform = "translateY(-10px) rotate(3deg)";
    img.style.transition = "transform 0.3s ease"; 
  });

  img.addEventListener("mouseout", () => {
    img.style.transform = "translateY(0) rotate(0)"; 
  });
});

document.querySelector(".signup-btn1").addEventListener("click", () => {
    document.querySelector("#modal").style.display = "block";
  });
  
  document.querySelector("#closeModal").addEventListener("click", () => {
    document.querySelector("#modal").style.display = "none";
  });
  
  window.addEventListener("click", (event) => {
    const modal = document.querySelector("#modal");
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });

document.querySelector("#startFosterApplication").addEventListener("click", () => {
    document.querySelector("#modal").style.display = "none"; 
    document.querySelector("#applicationModal").style.display = "block";
  });
  
  document.querySelector("#closeModal").addEventListener("click", () => {
    document.querySelector("#modal").style.display = "none";
  });
  
  document.querySelector("#closeApplicationModal").addEventListener("click", () => {
    document.querySelector("#applicationModal").style.display = "none";
  });
  
  window.addEventListener("click", (event) => {
    const modal = document.querySelector("#modal");
    const applicationModal = document.querySelector("#applicationModal");
    if (event.target === modal) modal.style.display = "none";
    if (event.target === applicationModal) applicationModal.style.display = "none";
  });
 