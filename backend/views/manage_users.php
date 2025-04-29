<?php
require_once '../controllers/auth.php';
require_once '../config/db.php';
requireLogin();
$user = currentUser();

if ($user['role'] !== 'admin') {
  echo "<p>Access Denied.</p>";
  exit;
}

// Pagination & Search
$search = $_GET['search'] ?? '';
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 10;
$offset = ($page - 1) * $limit;

// Get total count
$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE name LIKE ?");
$totalStmt->execute(["%$search%"]);
$total = $totalStmt->fetchColumn();
$totalPages = ceil($total / $limit);

// Fetch users
$stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE name LIKE ? ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
$stmt->execute(["%$search%"]);
$users = $stmt->fetchAll();
?>

<link rel="stylesheet" href="../assets/css/manage-users.css">
  <div class="container">
    <h2>Manage Users</h2>

    <form method="GET" class="search-bar">
      <input type="text" name="search" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
      <button type="submit">Search</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr data-id="<?= $user['id'] ?>">
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['role']) ?></td>
            <td>
              <button class="edit-btn" onclick="editUser(<?= $user['id'] ?>)">Edit</button>
              <a href="../controllers/delete-user.php?id=<?= $user['id'] ?>" 
       class="delete-link" 
       onclick="return confirm('Are you sure you want to delete this user?')">Delete
    </a>

            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
      <?php endfor; ?>
    </div>
  </div>

  <!-- Edit Modal -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">×</span>
      <h3>Edit User</h3>
      <form id="editUserForm">
        <input type="hidden" name="id" id="editUserId">
        <label>Name:</label>
        <input type="text" name="name" id="editName" required>
        <label>Email:</label>
        <input type="email" name="email" id="editEmail" required>
        <label>Role:</label>
        <select name="role" id="editRole">
          <option value="admin">Admin</option>
          <option value="vendor">Vendor</option>
          <option value="customer">Customer</option>
        </select>
        <button type="submit">Update</button>
      </form>
    </div>
  </div>
  <script src="admin.js?v=<?= time() ?>"></script>

  <!-- <script src="admin.js"></script> -->
  




