<?php
require_once '../config/db.php';

$product_id = $_POST['product_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$category_id = $_POST['category_id'];

// Update product
$update = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, stock = ?, category_id = ? WHERE id = ?");
$update->execute([$name, $description, $price, $stock, $category_id, $product_id]);

// Handle variants
$variant_ids = $_POST['variant_id'];
$names = $_POST['variant_name'];
$values = $_POST['variant_value'];
$prices = $_POST['variant_price'];
$stocks = $_POST['variant_stock'];

for ($i = 0; $i < count($names); $i++) {
    if (!empty($variant_ids[$i])) {
        // Update existing
        $stmt = $pdo->prepare("UPDATE product_variants SET attribute_name = ?, attribute_value = ?, price = ?, stock = ? WHERE id = ?");
        $stmt->execute([$names[$i], $values[$i], $prices[$i], $stocks[$i], $variant_ids[$i]]);
    } else {
        // Insert new
        $stmt = $pdo->prepare("INSERT INTO product_variants (product_id, attribute_name, attribute_value, price, stock) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$product_id, $names[$i], $values[$i], $prices[$i], $stocks[$i]]);
    }
}

// Handle new media upload
foreach ($_FILES['media']['tmp_name'] as $key => $tmpPath) {
    if (!empty($tmpPath)) {
        $filename = basename($_FILES['media']['name'][$key]);
        $targetPath = '../../images/products/' . $filename;
        move_uploaded_file($tmpPath, $targetPath);

        $type = strpos($_FILES['media']['type'][$key], 'video') !== false ? 'video' : 'image';
        $stmt = $pdo->prepare("INSERT INTO product_media (product_id, media_type, media_url) VALUES (?, ?, ?)");
        $stmt->execute([$product_id, $type, $filename]);
    }
}

header("Location: ../views/manage-products.php");
exit;
