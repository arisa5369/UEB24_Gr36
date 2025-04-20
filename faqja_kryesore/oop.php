<?php
//Klasat dhe logjika bazë OOP për menaxhimin e kafshëve

class Pet {
    protected $id;
    protected $name;
    protected $age;
    protected $type;
    protected $image;
    
    public function __construct($id, $name, $age, $type, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->type = $type;
        $this->image = $image;
    }
    
    // Metodat Get
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getAge() { return $this->age; }
    public function getType() { return $this->type; }
    public function getImage() { return $this->image; }
    
    // Metodat Set
    public function setName($name) { $this->name = $name; }
    public function setAge($age) { if($age > 0) $this->age = $age; }
    public function setImage($image) { $this->image = $image; }
    
    
    public function display() {
        echo "<div class='pet-card'>";
        echo "<img src='{$this->image}' alt='{$this->name}'>";
        echo "<h3>{$this->name}</h3>";
        echo "<p>Type: {$this->type}</p>";
        echo "<p>Age: {$this->age} years</p>";
        echo "</div>";
    }
}

class Dog extends Pet {
    private $breed;
    
    public function __construct($id, $name, $age, $image, $breed) {
        parent::__construct($id, $name, $age, 'Dog', $image);
        $this->breed = $breed;
    }
    
    public function getBreed() { return $this->breed; }
    public function setBreed($breed) { $this->breed = $breed; }
    
    public function display() {
        parent::display();
        echo "<p>Breed: {$this->breed}</p>";
    }
    
    public function bark() {
        echo "<script>console.log('{$this->name} says: Woof woof!');</script>";
    }
}

// Funksioni për të shfaqur të gjitha kafshët
function displayAllPets() {
    // Këtu mund të merrni të dhëna nga databaza ose të përdorni të dhëna testuese
    $pets = [
        new Dog(1, 'Buddy','images/dog1.avif', 3, '', ),
        new Pet(2, 'Mia', 2, 'Cat', 'images/cat1.jpg')
    ];
    
    foreach($pets as $pet) {
        $pet->display();
        if($pet instanceof Dog) {
            $pet->bark();
        }
    }
}

// Nëse file-i thirret direkt, shfaq kafshët
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Pet Shelter - OOP Demo</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <h1>Our Pets</h1>
        <div class="pets-container">
            <?php displayAllPets(); ?>
        </div>
    </body>
    </html>
    <?php
}
?>