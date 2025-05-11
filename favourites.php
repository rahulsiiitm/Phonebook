<?php
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourite Contacts</title>
    <link rel="stylesheet" href="style.css">
    <meta name="description" content="Favourite Contacts Management">
</head>

<body>
    <div class="phone-container">
        <div class="contacts-container">
            <div class="header">
                <h1>Favourites</h1>
            </div>

            <div class="search-bar">
                <input type="search" id="search-input" placeholder="Search favourites">
            </div>

            <div class="contacts-list" id="contacts-list">
                <?php
                try {
                    $stmt = $pdo->query("SELECT ID, name, phone, email FROM contacts WHERE favourite = 1 ORDER BY name ASC");
                    while ($row = $stmt->fetch()) {
                        echo '<div class="contact" data-id="' . htmlspecialchars($row["ID"]) . '">
                                <div class="contact-info">
                                    <h3>' . htmlspecialchars($row["name"]) . '</h3>
                                    <p>' . htmlspecialchars($row["phone"]) . '</p>
                                    <p class="email">' . htmlspecialchars($row["email"] ?? "") . '</p>
                                </div>
                              </div>';
                    }
                } catch (PDOException $e) {
                    echo '<p class="error">Error fetching favourites. Please try again later.</p>';
                }
                ?>
            </div>

            <div class="bottom-nav">
                <a href="index.php" class="nav-link">Contacts</a>
                <a href="favourites.php" class="nav-link active">Favourites</a>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
