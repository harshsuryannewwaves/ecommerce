<?php
session_start();
require_once '../config/db.php';
require_once 'auth.php';

// Ensure user is logged in
if (!isLoggedIn()) {
    header("Location: ../views/auth/login.php");
    exit;
}

$userId = currentUser()['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = $_POST['cart_id'];

    if (isset($_POST['update'])) {
        $quantity = intval($_POST['quantity']);
        $stmt = $pdo->prepare("UPDATE cart_items SET quantity = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$quantity, $cartId, $userId]);
    }

    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ? AND user_id = ?");
        $stmt->execute([$cartId, $userId]);
    }

    header("Location: ../views/cart.php");
    exit;
}
