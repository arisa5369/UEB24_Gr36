const params = new URLSearchParams(window.location.search);
const catName = params.get("name");

fetch('cat.json')
    .then(response => response.json())
    .then(data => {
        const cat = data.find(c => c.name === catName);

        if (cat) {
            document.getElementById('cat-name').textContent = cat.name;
            document.getElementById('cat-name-display').textContent = cat.name;
            document.getElementById('cat-image').src = cat.image;
            document.getElementById('cat-breed').textContent = cat.breed;
            document.getElementById('cat-age').textContent = cat.age;
            document.getElementById('cat-gender').textContent = cat.gender;
            document.getElementById('cat-color').textContent = cat.color;
            document.getElementById('cat-personality').textContent = cat.personality;
            document.getElementById('cat-litter-trained').textContent = cat.litterTrained ? "Yes" : "No";
            document.getElementById('cat-health').textContent = cat.health;
        } else {
            document.querySelector('.content').innerHTML = '<p>Cat not found.</p>';
        }
    })
    .catch(error => console.error('Error fetching cat data:', error));