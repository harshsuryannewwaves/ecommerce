<?php
require_once '../config/db.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$category_id = $_POST['category_id'];

// Insert product
$stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock, category_id) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$name, $description, $price, $stock, $category_id]);
$product_id = $pdo->lastInsertId();

// Handle variants
if (!empty($_POST['variant_name'])) {
    $variantStmt = $pdo->prepare("INSERT INTO product_variants (product_id, attribute_name, attribute_value, price, stock) VALUES (?, ?, ?, ?, ?)");
    for ($i = 0; $i < count($_POST['variant_name']); $i++) {
        $variantStmt->execute([
            $product_id,
            $_POST['variant_name'][$i],
            $_POST['variant_value'][$i],
            $_POST['variant_price'][$i],
            $_POST['variant_stock'][$i]
        ]);
    }
}

// Handle media upload
foreach ($_FILES['media']['tmp_name'] as $key => $tmpPath) {
    $filename = basename($_FILES['media']['name'][$key]);
    $targetPath = '../../images/products/' . $filename;
    move_uploaded_file($tmpPath, $targetPath);

    $type = strpos($_FILES['media']['type'][$key], 'video') !== false ? 'video' : 'image';
    $mediaStmt = $pdo->prepare("INSERT INTO product_media (product_id, media_type, media_url) VALUES (?, ?, ?)");
    $mediaStmt->execute([$product_id, $type, $filename]);
}

header("Location: ../views/dashboard.php");
exit;
