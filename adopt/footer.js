fetch('../adopt/footer.html')
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok ' + response.statusText);
    }
    return response.text();
  })
  .then(data => {
    document.getElementById('footer').innerHTML = data;

    // Dynamically load footer.css
    const footerStyle = document.createElement('link');
    footerStyle.rel = 'stylesheet';
    footerStyle.href = '../adopt/footer.css';
    document.head.appendChild(footerStyle);
  })
  .catch(error => console.error('Error loading footer:', error));