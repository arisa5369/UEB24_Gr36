<?php
session_start();
include '../databaza/db_connect.php';

if (!$conn) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . pg_last_error()]));
}

$filters = [
    'lloji_kafshes' => $_POST['lloji_kafshes'] ?? $_COOKIE['lloji_kafshes'] ?? '',
    'mosha_kafshes' => $_POST['mosha_kafshes'] ?? $_COOKIE['mosha_kafshes'] ?? '',
    'gender' => $_POST['gender'] ?? $_COOKIE['gender'] ?? '',
    'color' => $_POST['color'] ?? $_COOKIE['color'] ?? '',
    'personality' => $_POST['personality'] ?? $_COOKIE['personality'] ?? ''
];

$fallback_image = '/UEB24_Gr36/adopt/images/default_pet.jpg';

function calculateScore($pet, $filters) {
    $score = 0;
    if (!empty($filters['lloji_kafshes']) && $pet['type'] == $filters['lloji_kafshes']) {
        $score += 2;
    }
    if (!empty($filters['mosha_kafshes'])) {
        if ($filters['mosha_kafshes'] == 'I ri' && $pet['age'] >= 0 && $pet['age'] <= 2) {
            $score += 1;
        } elseif ($filters['mosha_kafshes'] == 'I rritur' && $pet['age'] >= 3 && $pet['age'] <= 7) {
            $score += 1;
        } elseif ($filters['mosha_kafshes'] == 'I vjetër' && $pet['age'] >= 8) {
            $score += 1;
        }
    }
    if (!empty($filters['gender']) && $pet['gender'] == $filters['gender']) {
        $score += 1;
    }
    if (!empty($filters['color']) && $pet['color'] == $filters['color']) {
        $score += 0.5;
    }
    if (!empty($filters['personality']) && stripos($pet['personality'], $filters['personality']) !== false) {
        $score += 0.5;
    }
    return $score;
}

function getPetImage($image) {
    global $fallback_image;
    $base_path = '/UEB24_Gr36/adopt/';
    if (!empty($image) && file_exists($_SERVER['DOCUMENT_ROOT'] . $image)) {
        return $image;
    } elseif (!empty($image)) {
        $image_path = $base_path . 'images/' . basename($image);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
            return $image_path;
        }
    }
    return $fallback_image;
}

$query = "SELECT p.id, p.type, p.name, p.age, p.gender, p.color, p.personality, p.image,
                 d.breed AS dog_breed, c.breed AS cat_breed, c.litter_trained, c.health AS cat_health,
                 r.breed AS rabbit_breed, r.house_trained AS rabbit_house_trained, r.health AS rabbit_health,
                 b.species, b.health AS bird_health, b.wingspan
          FROM pets p
          LEFT JOIN dogs d ON p.id = d.pet_id AND p.type = 'Dog'
          LEFT JOIN cats c ON p.id = c.pet_id AND p.type = 'Cat'
          LEFT JOIN rabbits r ON p.id = r.pet_id AND p.type = 'Rabbit'
          LEFT JOIN birds b ON p.id = b.pet_id AND p.type = 'Bird'
          WHERE 1=1";

$params = [];
$param_count = 1;

if (!empty($filters['lloji_kafshes'])) {
    $query .= " AND p.type = $$param_count";
    $params[] = $filters['lloji_kafshes'];
    $param_count++;
}
if (!empty($filters['gender'])) {
    $query .= " AND p.gender = $$param_count";
    $params[] = $filters['gender'];
    $param_count++;
}
if (!empty($filters['color'])) {
    $query .= " AND p.color = $$param_count";
    $params[] = $filters['color'];
    $param_count++;
}
if (!empty($filters['personality'])) {
    $query .= " AND p.personality ILIKE $$param_count";
    $params[] = '%' . $filters['personality'] . '%';
    $param_count++;
}
if (!empty($filters['mosha_kafshes'])) {
    if ($filters['mosha_kafshes'] == 'I ri') {
        $query .= " AND p.age BETWEEN 0 AND 2";
    } elseif ($filters['mosha_kafshes'] == 'I rritur') {
        $query .= " AND p.age BETWEEN 3 AND 7";
    } elseif ($filters['mosha_kafshes'] == 'I vjetër') {
        $query .= " AND p.age >= 8";
    }
}

$result = pg_query_params($conn, $query, $params);
$pets = [];
$exact_matches = false;

while ($row = pg_fetch_assoc($result)) {
    $score = calculateScore($row, $filters);
    $row['score'] = $score;
    $row['image'] = getPetImage($row['image']);
    $pets[] = $row;
    if ($score >= 2) {
        $exact_matches = true;
    }
}

if (empty($pets)) {
    $query = "SELECT p.id, p.type, p.name, p.age, p.gender, p.color, p.personality, p.image,
                     d.breed AS dog_breed, c.breed AS cat_breed, c.litter_trained, c.health AS cat_health,
                     r.breed AS rabbit_breed, r.house_trained AS rabbit_house_trained, r.health AS rabbit_health,
                     b.species, b.health AS bird_health, b.wingspan
              FROM pets p
              LEFT JOIN dogs d ON p.id = d.pet_id AND p.type = 'Dog'
              LEFT JOIN cats c ON p.id = c.pet_id AND p.type = 'Cat'
              LEFT JOIN rabbits r ON p.id = r.pet_id AND p.type = 'Rabbit'
              LEFT JOIN birds b ON p.id = b.pet_id AND p.type = 'Bird'
              WHERE 1=1";

    $params = [];
    $param_count = 1;

    if (!empty($filters['lloji_kafshes'])) {
        $query .= " AND p.type = $$param_count";
        $params[] = $filters['lloji_kafshes'];
        $param_count++;
    } elseif (!empty($filters['mosha_kafshes'])) {
        if ($filters['mosha_kafshes'] == 'I ri') {
            $query .= " AND p.age BETWEEN 0 AND 2";
        } elseif ($filters['mosha_kafshes'] == 'I rritur') {
            $query .= " AND p.age BETWEEN 3 AND 7";
        } elseif ($filters['mosha_kafshes'] == 'I vjetër') {
            $query .= " AND p.age >= 8";
        }
    }

    $result = pg_query_params($conn, $query, $params);
    while ($row = pg_fetch_assoc($result)) {
        $score = calculateScore($row, $filters);
        $row['score'] = $score;
        $row['image'] = getPetImage($row['image']);
        $pets[] = $row;
    }
}

usort($pets, function($a, $b) {
    return $b['score'] <=> $a['score'];
});
$pets = array_slice($pets, 0, 4);

$filtered_pets_html = '';
$wishlist = $_SESSION['wishlist'] ?? [];
$max_score = 5;

if (!empty($pets)) {
    foreach ($pets as $pet) {
        $is_favorite = in_array($pet['name'], $wishlist) ? 'favorite' : '';
        $filtered_pets_html .= "<div class='pet-card'>";
        $filtered_pets_html .= "<img src='".htmlspecialchars($pet['image'])."' alt='".htmlspecialchars($pet['name'])."' class='pet-image' data-link='/UEB24_Gr36/adopt/".strtolower($pet['type'])."s/".strtolower($pet['type']).".php?name=".urlencode($pet['name'])."'>";
        $filtered_pets_html .= "<p>".htmlspecialchars($pet['name'])." (".htmlspecialchars($pet['type']).")</p>";
        $filtered_pets_html .= "<p>Përputhje: ".round(($pet['score'] / $max_score) * 100)."%</p>";
        if (!$exact_matches) 
        $filtered_pets_html .= "<button class='heart-button $is_favorite' data-pet='".htmlspecialchars($pet['name'])."' title='".($is_favorite ? 'Fshi nga Wishlist' : 'Shto në Wishlist')."'>";
        $filtered_pets_html .= '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
        $filtered_pets_html .= "</button>";
        $filtered_pets_html .= "</div>";
    }
} else {
    $filtered_pets_html = "<p style='color: #555;'>Asnjë kafshë e disponueshme për momentin.</p>";
}

pg_close($conn);

echo json_encode([
    'success' => true,
    'filtered_pets' => $filtered_pets_html
]);
?>