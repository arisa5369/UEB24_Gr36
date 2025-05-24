<?php
include 'db_connect.php';

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Insert Dogs
$query = "INSERT INTO pets (type, name, age, gender, color, personality, image) VALUES 
          ('Dog', 'Buddy', 2, 'Male', 'Golden', 'Friendly, Playful, Loyal', '/images/dog1.avif'),
          ('Dog', 'Luna', 1, 'Female', 'Brown', 'Affectionate, Energetic,Sociable', '../images/dog2.jpg'),
          ('Dog', 'Rocco', 2, 'Male', 'Black', 'Energetic, Enthusiastic, Spirited', '../images/dog3.jpg'),
          ('Dog', 'Ozzy', 1, 'Female', 'Brown', 'Cheerful, Outgoing,Relaxed', '../images/dog4.jpg'),
          ('Dog', 'Champ', 2, 'Male', 'Brown', 'Curious,Independent,Determined', '../images/dog5.jpg'),
          ('Dog', 'Ginger', 1, 'Female', 'white', 'Playful, Loyal, Affectionate', '../images/dog6.webp'),
          ('Dog', 'Apollo', 3, 'Male', 'Black & Brown', 'Alert,Friendly, Loyal', '../images/dog7.webp'),
          ('Dog', 'Milo', 4, 'Female', 'Black & White', 'Intelligent, Energetic', '../images/dog8.webp'),
          ('Dog', 'Gunter', 3, 'Male', 'Black & Brown', 'Protective, Alert ,Brave', '../images/dog9.webp'),
          ('Dog', 'Lulu', 1, 'Female', 'Brown & White', 'Affectionate, Energetic, Playful', '../images/dog10.jpg')
          RETURNING id";
$result = pg_query($conn, $query);
$petIds = [];
while ($row = pg_fetch_assoc($result)) {
    $petIds[] = $row['id'];
}
$query = "INSERT INTO dogs (pet_id, breed, house_trained) VALUES 
          ($petIds[0], 'Golden Retriever', TRUE),
          ($petIds[1], 'Yorkshire Terrier', TRUE),
          ($petIds[2], 'German Shepherd', TRUE),
          ($petIds[3], 'Staffordshire Bull Terrier', TRUE),
          ($petIds[4], 'Pitbull', TRUE),
          ($petIds[5], 'Pomeranian', TRUE),
          ($petIds[6], 'Rottweiler', TRUE),
          ($petIds[7], 'Husky', TRUE),
          ($petIds[8], 'Alaskan Shepherd', TRUE),
          ($petIds[9], 'Goberian', TRUE)";
pg_query($conn, $query);
echo "Inserted 10 Dogs (IDs: " . implode(', ', $petIds) . ")<br>";

// Insert Cats
$query = "INSERT INTO pets (type, name, age, gender, color, personality, image) VALUES 
          ('Cat', 'Tom', 3, 'Male', 'Orange', 'Playful and curious', '../images/cat1.jpg'),
          ('Cat', 'Bella', 2, 'Female', 'Grey', 'Calm and affectionate', '../images/cat2.jpg'),
          ('Cat', 'Jasper', 4, 'Male', 'Spotted Black and Silver', 'Energetic and vocal', '../images/cat3.jpeg'),
          ('Cat', 'Coco', 1, 'Female', 'Brown, Black, and White', 'Friendly and adventurous', '../images/cat4.jpg'),
          ('Cat', 'Oliver', 2, 'Male', 'White and Orange', 'Cuddly and lazy', '../images/cat5.jpg'),
          ('Cat', 'Daisy', 1, 'Female', 'Brown and Black', 'Shy but affectionate', '../images/cat6.jpg'),
          ('Cat', 'Ralph', 5, 'Male', 'Brown Tabby', 'Gentle giant', '../images/cat7.jpg'),
          ('Cat', 'Willow', 3, 'Female', 'White and Grey', 'Laid-back and sweet', '../images/cat8.jpg'),
          ('Cat', 'Milo', 2, 'Male', 'Brown and White', 'Playful and adventurous', '../images/cat9.avif'),
          ('Cat', 'Cleo', 4, 'Female', 'White and Orange', 'Independent and confident', '../images/cat10.webp')
          RETURNING id";
$result = pg_query($conn, $query);
$petIds = [];
while ($row = pg_fetch_assoc($result)) {
    $petIds[] = $row['id'];
}
$query = "INSERT INTO cats (pet_id, breed, litter_trained, health) VALUES 
          ($petIds[0], 'Ginger Tabby', TRUE, 'Good'),
          ($petIds[1], 'British Shorthair', TRUE, 'Good'),
          ($petIds[2], 'Bengal', TRUE, 'Excellent'),
          ($petIds[3], 'Calico', TRUE, 'Good'),
          ($petIds[4], 'Domestic Shorthair', TRUE, 'Good'),
          ($petIds[5], 'Tabby', TRUE, 'Good'),
          ($petIds[6], 'Maine Coon', TRUE, 'Good'),
          ($petIds[7], 'Ragdoll', TRUE, 'Excellent'),
          ($petIds[8], 'Siberian', TRUE, 'Good'),
          ($petIds[9], 'Domestic Shorthair', TRUE, 'Good')";
pg_query($conn, $query);
echo "Inserted 10 Cats (IDs: " . implode(', ', $petIds) . ")<br>";

// Insert Rabbits
$query = "INSERT INTO pets (type, name, age, gender, color, personality, image) VALUES 
          ('Rabbit', 'Houdini', 1, 'Male', 'Brown', 'Curious, Intelligent, Playful', '../images/rabbit1.jpg'),
          ('Rabbit', 'Snowball', 2, 'Female', 'White', 'Affectionate, Calm, Sociable', '../images/rabbit2.jpg'),
          ('Rabbit', 'Clumsy', 1, 'Male', 'Tan', 'Gentle, Relaxed, Sweet', '../images/rabbit3.avif'),
          ('Rabbit', 'Stompy', 3, 'Male', 'Gray', 'Friendly, Outgoing, Sociable', '../images/rabbit4.jpg'),
          ('Rabbit', 'Peter', 2, 'Male', 'Tan & White', 'Energetic, Brave', '../images/rabbit5.jpg'),
          ('Rabbit', 'Oreo', 1, 'Female', 'Black & White', 'Curious, Playful, Affectionate', '../images/rabbit6.jpg'),
          ('Rabbit', 'Bobbin', 2, 'Male', 'White with Spots', 'Cheerful, Relaxed, Gentle', '../images/rabbit7.webp'),
          ('Rabbit', 'Bun', 1, 'Female', 'Orange', 'Energetic, Curious, Independent', '../images/rabbit8.jpg'),
          ('Rabbit', 'Ruby', 3, 'Female', 'Gray', 'Affectionate, Calm, Loyal', '../images/rabbit9.jpg'),
          ('Rabbit', 'Floppy', 2, 'Male', 'Brown', 'Playful, Sociable, Gentle', '../images/rabbit10.jpg')
          RETURNING id";
$result = pg_query($conn, $query);
$petIds = [];
while ($row = pg_fetch_assoc($result)) {
    $petIds[] = $row['id'];
}
$query = "INSERT INTO rabbits (pet_id, breed, house_trained, health) VALUES 
          ($petIds[0], 'American Rabbit', TRUE, 'Vaccinated, Neutered'),
          ($petIds[1], 'White Vienna', TRUE, 'Vaccinated, Spayed'),
          ($petIds[2], 'Holland Lop', TRUE, 'Neutered, Up-to-date on Vaccines'),
          ($petIds[3], 'Flemish Giant', FALSE, 'Vaccinated, Healthy Teeth'),
          ($petIds[4], 'Lionhead', TRUE, 'Neutered, Regular Vet Check-ups'),
          ($petIds[5], 'Dutch Rabbit', TRUE, 'Spayed, Flea/Tick Treated'),
          ($petIds[6], 'Mini Rex', FALSE, 'Vaccinated, Dewormed'),
          ($petIds[7], 'Netherland Dwarf', TRUE, 'Spayed, Healthy Coat'),
          ($petIds[8], 'English Lop', FALSE, 'Vaccinated, Parasite-free'),
          ($petIds[9], 'French Lop', TRUE, 'Neutered, Up-to-date on Vaccines')";
pg_query($conn, $query);
echo "Inserted 10 Rabbits (IDs: " . implode(', ', $petIds) . ")<br>";

// Insert Birds
$query = "INSERT INTO pets (type, name, age, gender, color, personality, image) VALUES 
          ('Bird', 'Bruno', 3, 'Male', 'White', 'Playful and affectionate', '../images/bird1.jpg'),
          ('Bird', 'Dale', 5, 'Female', 'Blue and Gold', 'Loyal and intelligent', '../images/bird2.jpg'),
          ('Bird', 'Stella', 2, 'Female', 'Green and Yellow', 'Chirpy and curious', '../images/bird3.jpeg'),
          ('Bird', 'Tori', 6, 'Male', 'White with Yellow Crest', 'Social and talkative', '../images/bird4.jpg'),
          ('Bird', 'Feathers', 1, 'Female', 'Grey and Orange', 'Energetic and friendly', '../images/bird5.webp'),
          ('Bird', 'Mango', 2, 'Male', 'Yellow', 'Melodious and active', '../images/bird6.jpg'),
          ('Bird', 'Whisles', 3, 'Female', 'Blue', 'Calm and observant', '../images/bird7.jpg'),
          ('Bird', 'Pico', 4, 'Male', 'Yellow, Orange, and Green', 'Cheerful and friendly', '../images/bird8.jpg'),
          ('Bird', 'Hula', 1, 'Female', 'Brown', 'Quick and curious', '../images/bird9.jpg'),
          ('Bird', 'Tinker', 2, 'Male', 'Red and Brown', 'Friendly and vocal', '../images/bird10.jpg')
          RETURNING id";
$result = pg_query($conn, $query);
$petIds = [];
while ($row = pg_fetch_assoc($result)) {
    $petIds[] = $row['id'];
}
$query = "INSERT INTO birds (pet_id, species, health, wingspan) VALUES 
          ($petIds[0], 'Cockatoo', 'Excellent', 50),
          ($petIds[1], 'Macaw', 'Healthy', 100),
          ($petIds[2], 'Budgerigar', 'Excellent', 20),
          ($petIds[3], 'Sulphur-Crested Cockatoo', 'Healthy', 55),
          ($petIds[4], 'Zebra Finch', 'Excellent', 12),
          ($petIds[5], 'Canary', 'Healthy', 15),
          ($petIds[6], 'Bluebird', 'Excellent', 25),
          ($petIds[7], 'Sun Conure', 'Healthy', 30),
          ($petIds[8], 'Sparrow', 'Excellent', 15),
          ($petIds[9], 'House Finch', 'Healthy', 20)";
pg_query($conn, $query);
echo "Inserted 10 Birds (IDs: " . implode(', ', $petIds) . ")<br>";

pg_close($conn);
?>