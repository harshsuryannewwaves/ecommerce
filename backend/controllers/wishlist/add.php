<?php
session_start();
require_once "../../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../../views/auth/login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = $_POST['product_id'];

// Check for duplicates
$sql = "SELECT 1 FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id, 'product_id' => $product_id]);

if ($stmt->rowCount() === 0) {
    $insert = $pdo->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)");
    $insert->execute(['user_id' => $user_id, 'product_id' => $product_id]);
}

header("Location: ../../views/wishlist.php");
exit;
?>
