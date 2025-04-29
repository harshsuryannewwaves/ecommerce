<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['image'];

    $imageName = time() . '_' . basename($image['name']);
    $targetPath = '../../images/products/' . $imageName;
    move_uploaded_file($image['tmp_name'], $targetPath);

    $stmt = $pdo->prepare("INSERT INTO products (name, category_id, price, stock, image, created_at, updated_at, is_deleted)
                           VALUES (?, ?, ?, ?, ?, NOW(), NOW(), 0)");
    $stmt->execute([$name, $category_id, $price, $stock, $imageName]);

    header("Location: ../views/dashboard.php");
    exit;
}
?>
