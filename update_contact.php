<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    try {
        $stmt = $pdo->prepare("UPDATE contacts SET name = ?, phone = ?, email = ? WHERE ID = ?");
        $stmt->execute([$name, $phone, $email, $id]);

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
?>