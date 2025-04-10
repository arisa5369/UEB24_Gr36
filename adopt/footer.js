fetch('/UEB24_Gr36/adopt/footer.php')
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok ' + response.statusText);
    }
    return response.text();
  })
  .then(data => {
    const footer = document.getElementById('footer');
    footer.innerHTML = data;
    footer.style.display = 'block'; 

    
    const footerStyle = document.createElement('link');
    footerStyle.rel = 'stylesheet';
    footerStyle.href = '/UEB24_Gr36/adopt/footer.css';
    document.head.appendChild(footerStyle);
  })
  .catch(error => console.error('Error loading footer:', error));
