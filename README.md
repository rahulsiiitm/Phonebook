# 📞 Phonebook Application

A simple and responsive web-based Phonebook Application with full CRUD (Create, Read, Update, Delete) functionality. Built using PHP, MySQL, JavaScript, HTML, and CSS, the app allows users to manage their contacts efficiently and mark favourites.

---

## 🚀 Features

- Add new contacts
- Edit existing contacts
- Delete contacts
- Mark/unmark contacts as favourites
- Search through favourite contacts
- Fetch all contacts dynamically using AJAX
- Responsive UI for seamless experience across devices

---

## 🗂️ Project Files

- `db.php`  
  Connects to the MySQL database.

- `index.php`  
  Main UI for adding, editing, and deleting contacts.

- `fetch_contacts.php`  
  Retrieves all contacts in JSON format.

- `delete_contact.php`  
  Handles deletion of contacts via POST requests.

- `update_contact.php`  
  Updates contact information using POST requests.

- `toggle_favourite.php`  
  Toggles the favourite status of a contact.

- `favourites.php`  
  Displays only favourite contacts with a search bar.

- `script.js`  
  Manages AJAX requests and UI interactions (e.g., modal control).

- `style.css`  
  Provides styling for a clean and responsive design.

---

## 💾 Setup Instructions

1. **Clone or download this repository**
   ```bash
   git clone https://github.com/your-username/phonebook-app.git
   cd phonebook-app
   ```

2. **Set up the database**
   - Create a MySQL database named `phonebook`.
   - Create a `contacts` table using the following SQL schema:

     ```sql
     CREATE TABLE contacts (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       phone VARCHAR(20) NOT NULL,
       email VARCHAR(100),
       is_favourite BOOLEAN DEFAULT FALSE
     );
     ```

   - Update your `db.php` with the correct database credentials.

3. **Run the app**
   - Use XAMPP, WAMP, or any PHP server.
   - Navigate to `http://localhost/phonebook-app/index.php` in your browser.

---

## 📌 Notes

- Make sure your server supports PHP and MySQL.
- The app uses AJAX for dynamic updates without page reloads.

---

## 📄 License

This project is open source and free to use for learning and personal projects.
