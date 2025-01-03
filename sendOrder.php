<?php
// Předpokládáme, že obdržíte data jako JSON
$data = json_decode(file_get_contents('php://input'), true);

// Odeslat email zákazníkovi
$to = $data['email'];
$subject = "Potvrzení objednávky";
$message = "Děkujeme za vaši objednávku:\n" . print_r($data['cartItems'], true);
mail($to, $subject, $message);

// Odeslat email správci s podrobnými informacemi
$adminEmail = "admin@example.com"; // Zde zadejte email správce
$adminSubject = "Nová objednávka od " . $data['name'];
$adminMessage = "Nová objednávka:\n" .
                "Jméno: " . $data['name'] . "\n" .
                "Adresa: " . $data['address'] . "\n" .
                "Město: " . $data['city'] . "\n" .
                "PSČ: " . $data['postalCode'] . "\n" .
                "Telefon: " . $data['phone'] . "\n" .
                "Email: " . $data['email'] . "\n" .
                "Způsob dopravy: " . $data['paymentMethod'] . "\n" .
                "Místo vyzvednutí: " . $data['pickupPoint'] . "\n" .
                "Položky v košíku: " . print_r($data['cartItems'], true);
mail($adminEmail, $adminSubject, $adminMessage);

// Odpovědět na požadavek
http_response_code(200);
echo json_encode(["status" => "success"]);
?>
