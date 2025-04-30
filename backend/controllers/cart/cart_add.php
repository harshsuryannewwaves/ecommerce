<?php
// session_start();
require_once '../../config/db.php';
require_once '../auth.php';

if (!isLoggedIn()) {
    echo "Please login to add to cart.";
    exit;
}

$userId = currentUser()['id'];

if (isset($_GET['product_id']) && isset($_GET['qty'])) {
    $productId = intval($_GET['product_id']);
    $quantity = intval($_GET['qty']);

    // Check if the product is already in the cart
    $stmt = $pdo->prepare("SELECT id, quantity FROM cart_items WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$userId, $productId]);
    $existing = $stmt->fetch();

    if ($existing) {
        // Update quantity
        $newQty = $existing['quantity'] + $quantity;
        $updateStmt = $pdo->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
        $updateStmt->execute([$newQty, $existing['id']]);
        echo "Quantity updated in cart.";
    } else {
        // Insert new item
        $insertStmt = $pdo->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insertStmt->execute([$userId, $productId, $quantity]);
        echo "Added to cart.";
    }
} else {
    echo "Invalid request.";
}
