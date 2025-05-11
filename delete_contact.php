<?php
require_once 'db.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? null;

    if (!$id || !is_numeric($id)) {
        echo json_encode(["success" => false, "error" => "Invalid ID"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Contact not found"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => "Database error: " . $e->getMessage()]);
    }
}
?>
