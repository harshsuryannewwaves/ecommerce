<?php
require_once '../controllers/auth.php';
requireLogin();
$user = currentUser();

if ($user['role'] !== 'admin') {
    echo "<p>Access Denied.</p>";
    exit;
}

require_once '../config/db.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM products ORDER BY created_at DESC");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<link rel="stylesheet" href="../assets/css/manage-products.css">

<div class="products-container">
    <h2>Manage Products</h2>
    <table class="products-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price (₹)</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><img src="../../images/products/<?= htmlspecialchars($row['image']) ?>" alt="Product" class="thumb"></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['category_id']) ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td>
                <a href="#" onclick="openEditModal(<?= htmlspecialchars(json_encode($row)) ?>)">✏️ Edit</a> |
                    <a href="../../controllers/delete-product.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditModal()">×</span>
        <h3>Edit Product</h3>
        <form id="editForm" method="POST" action="../../controllers/update-product.php">
            <input type="hidden" name="id" id="edit-id">
            <label>Name:</label>
            <input type="text" name="name" id="edit-name" required>

            <label>Category:</label>
            <input type="text" name="category" id="edit-category" required>

            <label>Price:</label>
            <input type="number" name="price" id="edit-price" step="0.01" required>

            <label>Stock:</label>
            <input type="number" name="stock" id="edit-stock" required>

            <button type="submit">Update Product</button>
        </form>
    </div>
</div>

<script>
function openEditModal(data) {
    document.getElementById('edit-id').value = data.id;
    document.getElementById('edit-name').value = data.name;
    document.getElementById('edit-category').value = data.category;
    document.getElementById('edit-price').value = data.price;
    document.getElementById('edit-stock').value = data.stock;
    document.getElementById('editModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>
