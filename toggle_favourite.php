<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $favourite = $_POST["favourite"];

    $stmt = $pdo->prepare("UPDATE contacts SET favourite = ? WHERE ID = ?");
    if ($stmt->execute([$favourite, $id])) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to update favourite"]);
    }
}
?>
