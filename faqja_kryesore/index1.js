function openModal() {
    var modal = document.getElementById('myModal');
    modal.classList.add('show'); 
}

function closeModal() {
    var modal = document.getElementById('myModal');
    modal.classList.remove('show'); 
}

setTimeout(openModal, 2000);


document.addEventListener("DOMContentLoaded", () => {
    const steps = document.querySelectorAll(".step");
  
    steps.forEach((step) => {
      step.addEventListener("mouseenter", () => {
        step.style.backgroundColor = "#d1f5f5"; 
        step.style.transform = "scale(1.05)"; 
        step.style.transition = "all 0.3s ease"; 
      });
  
      step.addEventListener("mouseleave", () => {
        step.style.backgroundColor = "#eaf5f5"; 
        step.style.transform = "scale(1)"; 
      });
    });
  });
  window.addEventListener('scroll', function() {
    var steps = document.querySelectorAll('.adopting-expectations .step');
    
    steps.forEach(function(step) {
        var stepPosition = step.getBoundingClientRect().top;
        var screenPosition = window.innerHeight;

        if (stepPosition < screenPosition) {
            step.classList.add('animate');
        }
    });
});
