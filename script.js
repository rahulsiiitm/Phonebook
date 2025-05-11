document.addEventListener("DOMContentLoaded", function () {
    const addModal = document.getElementById("add-contact-modal"),
        editModal = document.getElementById("edit-contact-modal"),
        contactForm = document.getElementById("add-contact-form"),
        editForm = document.getElementById("edit-contact-form"),
        contactsList = document.getElementById("contacts-list"),
        searchInput = document.getElementById("search-input");

    // Open/Close Modals
    document.getElementById("open-add-form").addEventListener("click", () => addModal.style.display = "block");
    document.querySelectorAll(".close-modal, .cancel-btn").forEach(btn =>
        btn.addEventListener("click", () => closeModal())
    );

    function closeModal() {
        [addModal, editModal].forEach(modal => modal.style.display = "none");
        contactForm.reset();
        editForm.reset();
    }

    // Fetch & Render Contacts
    function fetchContacts() {
        fetch("fetch_contacts.php")
            .then(res => res.json())
            .then(data => {
                contactsList.innerHTML = data.length
                    ? data.map(contactTemplate).join("")
                    : "<p class='error'>No contacts found.</p>";
            })
            .catch(() => contactsList.innerHTML = "<p class='error'>Failed to load contacts</p>");
    }

    function contactTemplate(contact) {
        return `
            <div class="contact" data-id="${contact.ID}">
                <div class="contact-info">
                    <h3>${escapeHTML(contact.name)}</h3>
                    <p>${escapeHTML(contact.phone)}</p>
                    <p class="email">${escapeHTML(contact.email || "")}</p>
                </div>
                <div class="contact-actions">
                    <button class="fav-btn" data-id="${contact.ID}" data-fav="${contact.favourite}">
                        ${contact.favourite == "1" ? "⭐" : "☆"}
                    </button>
                    <button class="edit-btn" data-id="${contact.ID}" data-name="${contact.name}" 
                        data-phone="${contact.phone}" data-email="${contact.email || ""}">Edit</button>
                    <button class="delete-btn" data-id="${contact.ID}">🗑</button>
                </div>
            </div>
        `;
    }

    function escapeHTML(str) {
        return str ? str.replace(/[&<>"']/g, m => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#039;" }[m])) : "";
    }

    // Handle Actions (Delete, Edit, Favorite)
    contactsList.addEventListener("click", function (event) {
        const btn = event.target, id = btn.dataset.id;
        if (btn.classList.contains("delete-btn") && confirm("Are you sure?")) {
            handleRequest("delete_contact.php", { id }, fetchContacts);
        } else if (btn.classList.contains("edit-btn")) {
            ["contact-id", "contact-name", "contact-phone", "contact-email"].forEach(field =>
                document.getElementById(`edit-${field}`).value = btn.dataset[field.split("-")[1]]
            );
            editModal.style.display = "block";
        } else if (btn.classList.contains("fav-btn")) {
            handleRequest("toggle_favourite.php", { id, favourite: btn.dataset.fav == "1" ? 0 : 1 }, fetchContacts);
        }
    });

    // Form Submissions
    [contactForm, editForm].forEach(form =>
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            handleRequest(this.id === "add-contact-form" ? "add_contact.php" : "update_contact.php", formData, () => {
                closeModal();
                fetchContacts();
            });
        })
    );

    function handleRequest(url, data, callback) {
        fetch(url, {
            method: "POST",
            body: data instanceof FormData ? data : new URLSearchParams(data)
        })
        .then(res => res.json())
        .then(data => data.success ? callback() : alert(data.message || "Error occurred"))
        .catch(error => console.error("Error:", error));
    }

    // Search Contacts
    searchInput.addEventListener("input", function () {
        const term = this.value.toLowerCase();
        document.querySelectorAll(".contact").forEach(contact =>
            contact.style.display = ["h3", "p", ".email"].some(sel =>
                contact.querySelector(sel)?.textContent.toLowerCase().includes(term)
            ) ? "" : "none"
        );
    });

    fetchContacts();
});
