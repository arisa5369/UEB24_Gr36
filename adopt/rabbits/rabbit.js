const params = new URLSearchParams(window.location.search);
const rabbitName = params.get("name");

fetch('rabbit.json')
    .then(response => response.json())
    .then(data => {
        const rabbit = data.find(r => r.name === rabbitName);
        if (rabbit) {
            document.getElementById('rabbit-name').textContent = rabbit.name;
            document.getElementById('rabbit-name-display').textContent = rabbit.name;
            document.getElementById('rabbit-image').src = rabbit.image;
            document.getElementById('rabbit-breed').textContent = rabbit.breed;
            document.getElementById('rabbit-age').textContent = rabbit.age;
            document.getElementById('rabbit-gender').textContent = rabbit.gender;
            document.getElementById('rabbit-color').textContent = rabbit.color;
            document.getElementById('rabbit-personality').textContent = rabbit.personality;
            document.getElementById('rabbit-house-trained').textContent = rabbit.houseTrained;
            document.getElementById('rabbit-health').textContent = rabbit.health;
        } else {
            document.querySelector('.content').innerHTML = '<p>Rabbit not found.</p>';
        }
    })
    .catch(error => console.error('Error fetching rabbit data:', error));
    document.getElementById('playable-gif').addEventListener('click', function() {
        const audio = document.getElementById('audio');
        if (!audio) {
            console.error('Audio element not found!');
            return;
        }
        if (audio.paused) {
            audio.play().catch(error => {
                console.error('Error playing audio:', error);
            });
        } else {
            audio.pause();
            audio.currentTime = 0; 
        }
    });