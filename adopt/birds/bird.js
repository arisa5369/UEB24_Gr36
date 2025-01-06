const params = new URLSearchParams(window.location.search);
const birdName = params.get("name");

fetch('bird.json')
    .then(response => response.json())
    .then(data => {
        const bird = data.find(b => b.name === birdName);

        if (bird) {
            document.getElementById('bird-name').textContent = bird.name;
            document.getElementById('bird-name-display').textContent = bird.name;
            document.getElementById('bird-image').src = `../images/${bird.image}`;
            document.getElementById('bird-species').textContent = bird.species;
            document.getElementById('bird-age').textContent = bird.age;
            document.getElementById('bird-gender').textContent = bird.gender;
            document.getElementById('bird-color').textContent = bird.color;
            document.getElementById('bird-personality').textContent = bird.personality;
            document.getElementById('bird-health').textContent = bird.health;
            document.getElementById('bird-wingspan').textContent = bird.wingspan;
        } else {
            document.querySelector('.content').innerHTML = '<p>Bird not found.</p>';
        }
    })
    .catch(error => console.error('Error fetching bird data:', error));
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
