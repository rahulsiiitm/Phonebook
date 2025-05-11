<?php
require 'db.php';

$name = $_POST["name"] ?? '';
$phone = $_POST["phone"] ?? '';
$email = $_POST["email"] ?? '';

if (empty($name) || empty($phone)) {
    echo json_encode(["success" => false, "message" => "Name and Phone are required"]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO contacts (name, phone, email) VALUES (:name, :phone, :email)");
    $stmt->execute(["name" => $name, "phone" => $phone, "email" => $email]);
    echo json_encode(["success" => true, "message" => "Contact added successfully"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "DB Error: " . $e->getMessage()]);
}

?>