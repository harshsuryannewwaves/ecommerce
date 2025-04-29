<?php
require_once '../config/db.php';
require_once '../controllers/auth.php';
requireLogin();

$user = currentUser();
if ($user['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

// Fetch categories for the dropdown
$categoryStmt = $pdo->query("SELECT id, name FROM categories WHERE parent_id IS NULL");
$categories = $categoryStmt->fetchAll();
?>

<link rel="stylesheet" href="../assets/css/manage-products.css">

<div class="create-product-container">
    <h2>Create Product</h2>
    <form action="../controllers/store-product.php" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" required>

        <label>Stock:</label>
        <input type="number" name="stock" required>

        <label>Category:</label>
        <select name="category_id" required>
            <option value="">-- Select Category --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Upload Image:</label>
        <input type="file" name="media[]" multiple accept="image/*,video/*">

        <div id="variant-section">
            <h4>Variants</h4>
            <button type="button" onclick="addVariant()">Add Variant</button>
        </div>

        <button type="submit">Create Product</button>
    </form>
</div>

<script>
function addVariant() {
    const section = document.getElementById("variant-section");
    const index = section.querySelectorAll('.variant-group').length;
    const group = document.createElement('div');
    group.className = 'variant-group';
    group.innerHTML = `
        <input type="text" name="variant_name[]" placeholder="Size/Color" required>
        <input type="text" name="variant_value[]" placeholder="e.g. M/Red" required>
        <input type="number" name="variant_price[]" placeholder="Price" step="0.01" required>
        <input type="number" name="variant_stock[]" placeholder="Stock" required>
        <button type="button" onclick="this.parentElement.remove()">❌</button>
    `;
    section.appendChild(group);
}
</script>
