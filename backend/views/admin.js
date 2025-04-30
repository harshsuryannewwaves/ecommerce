function loadContent(section) {
    const contentArea = document.getElementById('content-area');
    contentArea.innerHTML = `<p>Loading <strong>${section.replace(/-/g, ' ')}</strong>...</p>`;

    fetch(`../views/${section}.php`)
        .then(res => {
            if (!res.ok) throw new Error('Content load failed');
            return res.text();
        })
        .then(html => {
            contentArea.innerHTML = html;

            // 🔁 Re-initialize event bindings after content is loaded
            if (section === 'manage_users') {
                loadUserFormEvents();
            }
        })
        .catch(err => {
            contentArea.innerHTML = `<p>Error loading content.</p>`;
            console.error(err);
        });
}

function loadUserFormEvents() {
    const form = document.getElementById('editUserForm');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Stop form from reloading the page

            const id = document.getElementById('editUserId').value;
            const name = document.getElementById('editName').value;
            const email = document.getElementById('editEmail').value;
            const role = document.getElementById('editRole').value;

            const formData = new FormData();
            formData.append('id', id);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('role', role);

            fetch('../controllers/userController.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(resp => {
                    if (resp.success) {
                        alert("User updated!");
                        location.reload(); // Reload to reflect updates
                    } else {
                        alert("Update failed.");
                    }
                });
        });
    }

    // Attach edit user and close modal globally
    window.editUser = function (id) {
        fetch(`../controllers/userController.php?id=${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('editUserId').value = data.id;
                document.getElementById('editName').value = data.name;
                document.getElementById('editEmail').value = data.email;
                document.getElementById('editRole').value = data.role;
                document.getElementById('editModal').style.display = 'flex';
            });
    };

    window.closeModal = function () {
        document.getElementById('editModal').style.display = 'none';
    };
}
document.addEventListener('DOMContentLoaded', () => {
    loadUserFormEvents(); // Initial load
});
function openCreateModal() {
    document.getElementById('createModal').style.display = 'flex';
}

function closeCreateModal() {
    document.getElementById('createModal').style.display = 'none';
}
function updateStatus(orderId) {
    const form = document.querySelector(`#status-form-${orderId}`);
    const formData = new FormData(form);

    fetch('manage_orders.php', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.text())
    .then(responseText => {
        const msgBox = document.createElement('div');
        msgBox.innerHTML = responseText;
        msgBox.style.marginTop = '10px';
        form.parentElement.appendChild(msgBox);
        setTimeout(() => {
            msgBox.remove();
        }, 3000);
    })
    .catch(error => console.error('Error:', error));
}
function updateReturnStatus(returnId) {
    const form = document.querySelector(`#return-status-form-${returnId}`);
    const formData = new FormData(form);

    fetch('../controllers/update_return_status.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(response => {
        const msgDiv = document.querySelector(`#return-msg-${returnId}`);
        msgDiv.innerHTML = response;
        setTimeout(() => msgDiv.innerHTML = '', 3000);
    })
    .catch(err => console.error('Error:', err));
}