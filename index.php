<?php
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book Contacts</title>
    <link rel="stylesheet" href="style.css">
    <meta name="description" content="Phone Book Contact Management">
</head>

<body>
    <div class="phone-container">
        <div class="contacts-container">
            <div class="header">
                <h1>Contacts</h1>
                <div class="header-actions">
                    <button class="add-contact" id="open-add-form" aria-label="Add New Contact">+</button>
                </div>
            </div>

            <div class="search-bar">
                <input type="search" id="search-input" placeholder="Search contacts">
            </div>

            <div class="contacts-list" id="contacts-list">
                <?php
                try {
                    $stmt = $pdo->query("SELECT ID, name, phone, email, favourite FROM contacts ORDER BY name ASC");
                    while ($row = $stmt->fetch()) {
                        $isFav = $row["favourite"] ? "⭐" : "☆";
                        echo '<div class="contact" data-id="' . htmlspecialchars($row["ID"]) . '">
                                <div class="contact-info">
                                    <h3>' . htmlspecialchars($row["name"]) . '</h3>
                                    <p>' . htmlspecialchars($row["phone"]) . '</p>
                                    <p class="email">' . htmlspecialchars($row["email"] ?? "") . '</p>
                                </div>
                                <div class="contact-actions">
                                    <button class="fav-btn" data-id="' . htmlspecialchars($row["ID"]) . '">' . $isFav . '</button>
                                    <button class="edit-btn" data-id="' . htmlspecialchars($row["ID"]) . '" 
                                    data-name="' . htmlspecialchars($row["name"]) . '" 
                                    data-phone="' . htmlspecialchars($row["phone"]) . '" 
                                    data-email="' . htmlspecialchars($row["email"] ?? "") . '">Edit</button>
                                    <button class="delete-btn" data-id="' . htmlspecialchars($row["ID"]) . '">🗑</button>
                                </div>
                              </div>';
                    }
                } catch (PDOException $e) {
                    echo '<p class="error">Error fetching contacts. Please try again later.</p>';
                }
                ?>
            </div>

            <!-- Bottom Navigation Bar -->
            <div class="bottom-nav">
                <a href="index.php" class="nav-link active">Contacts</a>
                <a href="favourites.php" class="nav-link">Favourites</a>
            </div>
        </div>
    </div>

    <!-- Add Contact Modal -->
    <div id="add-contact-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Contact</h2>
                <span class="close-modal">&times;</span>
            </div>
            <form id="add-contact-form">
                <div class="form-group">
                    <label for="contact-name">Name</label>
                    <input type="text" id="contact-name" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="contact-phone">Phone</label>
                    <input type="tel" id="contact-phone" name="phone" placeholder="Enter phone number" required>
                </div>
                <div class="form-group">
                    <label for="contact-email">Email</label>
                    <input type="email" id="contact-email" name="email" placeholder="Enter email">
                </div>
                <div class="form-actions">
                    <button type="button" class="cancel-btn">Cancel</button>
                    <button type="submit" class="save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Contact Modal -->
    <div id="edit-contact-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Contact</h2>
                <span class="close-modal">&times;</span>
            </div>
            <form id="edit-contact-form">
                <input type="hidden" id="edit-contact-id" name="id">
                <div class="form-group">
                    <label for="edit-contact-name">Name</label>
                    <input type="text" id="edit-contact-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit-contact-phone">Phone</label>
                    <input type="tel" id="edit-contact-phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="edit-contact-email">Email</label>
                    <input type="email" id="edit-contact-email" name="email">
                </div>
                <div class="form-actions">
                    <button type="button" class="cancel-btn">Cancel</button>
                    <button type="submit" class="save-btn">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>