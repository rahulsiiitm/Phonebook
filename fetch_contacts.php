<?php
require 'db.php';

try {
    $stmt = $pdo->query("SELECT * FROM contacts ORDER BY name ASC");
    $contacts = $stmt->fetchAll();
    echo json_encode($contacts);
} catch (PDOException $e) {
    echo json_encode(["error" => "Failed to fetch contacts"]);
}
?>