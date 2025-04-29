<?php
require_once '../controllers/auth.php';
requireLogin();
$user = currentUser();

if ($user['role'] !== 'admin') {
    echo "<p>Access Denied.</p>";
    exit;
}

require_once '../config/db.php';

// Assume auth and database connection already handled

$stmt = $pdo->query("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE is_deleted = FALSE ORDER BY p.created_at DESC");
$products = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../assets/css/manage-products.css">
<div class="products-container">
    <h2>Manage Products <a href="create-product.php" class="create-btn">➕ Add New</a></h2>
    <table>
        <thead>
            <tr>
                <th>Product</th><th>Category</th><th>Variants</th><th>Images</th><th>Price</th><th>Stock</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <?php
            $variantStmt = $pdo->prepare("SELECT * FROM product_variants WHERE product_id = ?");
            $variantStmt->execute([$product['id']]);
            $variants = $variantStmt->fetchAll();

            $mediaStmt = $pdo->prepare("SELECT * FROM product_media WHERE product_id = ?");
            $mediaStmt->execute([$product['id']]);
            $media = $mediaStmt->fetchAll();
            ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['category_name']) ?></td>
                <td>
                    <?php foreach ($variants as $v): ?>
                        <div><?= "{$v['attribute_name']}: {$v['attribute_value']} - ₹{$v['price']} (Stock: {$v['stock']})" ?></div>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php foreach ($media as $m): ?>
                        <?php if ($m['media_type'] === 'image'): ?>
                            <img src="../../images/products/<?= $m['media_url'] ?>" class="thumb" alt="media">
                        <?php else: ?>
                            <video src="../../images/products/<?= $m['media_url'] ?>" class="thumb" controls></video>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['stock'] ?></td>
                <td>
                    <a href="edit-product.php?id=<?= $product['id'] ?>">✏️ Edit</a> |
                    <a href="../../controllers/delete-product.php?id=<?= $product['id'] ?>" onclick="return confirm('Delete this product?')">🗑️ Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
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

    function openCreateModal() {
        document.getElementById('createModal').style.display = 'flex';
    }

    function closeCreateModal() {
        document.getElementById('createModal').style.display = 'none';
    }
</script>