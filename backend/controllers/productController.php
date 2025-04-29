<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        updateProduct($pdo);
    }
}

function updateProduct($pdo) {
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    if (!$id) {
        echo "Product ID missing.";
        return;
    }

    try {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, price = ?, stock = ? WHERE id = ?");
        $stmt->execute([$name, $category, $price, $stock, $id]);
        header("Location: ../views/sections/manage-products.php?success=1");
        exit;
    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}
