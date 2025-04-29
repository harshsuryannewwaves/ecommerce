<?php
require_once '../config/db.php';
require_once '../controllers/auth.php';
requireLogin();

if (!isset($_GET['id'])) {
    echo "Product ID missing.";
    exit;
}

$product_id = $_GET['id'];

// Get product
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found.";
    exit;
}

// Get categories
$categories = $pdo->query("SELECT id, name FROM categories WHERE parent_id IS NULL")->fetchAll();

// Get variants
$variants = $pdo->prepare("SELECT * FROM product_variants WHERE product_id = ?");
$variants->execute([$product_id]);
$variants = $variants->fetchAll();

// Get media
$media = $pdo->prepare("SELECT * FROM product_media WHERE product_id = ?");
$media->execute([$product_id]);
$media = $media->fetchAll();
?>
<link rel="stylesheet" href="../assets/css/manage-products.css">
<h2>Edit Product</h2>
<form action="../controllers/update-product.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?= $product_id ?>">

    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label>Description:</label>
    <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>

    <label>Stock:</label>
    <input type="number" name="stock" value="<?= $product['stock'] ?>" required>

    <label>Category:</label>
    <select name="category_id" required>
        <option value="">-- Select --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h4>Variants</h4>
    <div id="variant-section">
        <?php foreach ($variants as $v): ?>
        <div class="variant-group">
            <input type="hidden" name="variant_id[]" value="<?= $v['id'] ?>">
            <input type="text" name="variant_name[]" value="<?= $v['attribute_name'] ?>" required>
            <input type="text" name="variant_value[]" value="<?= $v['attribute_value'] ?>" required>
            <input type="number" name="variant_price[]" value="<?= $v['price'] ?>" step="0.01" required>
            <input type="number" name="variant_stock[]" value="<?= $v['stock'] ?>" required>
            <button type="button" onclick="this.parentElement.remove()">❌</button>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="button" onclick="addVariant()">Add Variant</button>

    <label>Upload New Media (optional):</label>
    <input type="file" name="media[]" multiple accept="image/*,video/*">

    <h4>Existing Media:</h4>
    <?php foreach ($media as $m): ?>
        <div style="display:inline-block;margin:5px;">
            <?php if ($m['media_type'] == 'image'): ?>
                <img src="../../images/products/<?= $m['media_url'] ?>" height="60">
            <?php else: ?>
                <video src="../../images/products/<?= $m['media_url'] ?>" height="60" controls></video>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <br><br>
    <button type="submit">Update Product</button>
</form>

<script>
function addVariant() {
    const section = document.getElementById("variant-section");
    const div = document.createElement("div");
    div.className = "variant-group";
    div.innerHTML = `
        <input type="hidden" name="variant_id[]" value="">
        <input type="text" name="variant_name[]" placeholder="Attribute Name" required>
        <input type="text" name="variant_value[]" placeholder="Value" required>
        <input type="number" name="variant_price[]" placeholder="Price" step="0.01" required>
        <input type="number" name="variant_stock[]" placeholder="Stock" required>
        <button type="button" onclick="this.parentElement.remove()">❌</button>
    `;
    section.appendChild(div);
}
</script>
