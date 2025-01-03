const params = new URLSearchParams(window.location.search);
const dogName = params.get("name");

fetch('dog.json')
    .then(response => response.json())
    .then(data => {
        const dog = data.find(d => d.name === dogName);

        if (dog) {
            document.getElementById('dog-name').textContent = dog.name;
            document.getElementById('dog-name-display').textContent = dog.name;
            document.getElementById('dog-image').src = `../images/${dog.image}`;
            document.getElementById('dog-breed').textContent = dog.breed;
            document.getElementById('dog-age').textContent = dog.age;
            document.getElementById('dog-gender').textContent = dog.gender;
            document.getElementById('dog-color').textContent = dog.color;
            document.getElementById('dog-personality').textContent = dog.personality;
            document.getElementById('dog-house-trained').textContent = dog.houseTrained;
            document.getElementById('dog-health').textContent = dog.health;
        } else {
            document.querySelector('.content').innerHTML = '<p>Dog not found.</p>';
        }
    })
    .catch(error => console.error('Error fetching dog data:', error));