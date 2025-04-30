<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../../views/login.php");
    exit;
}

$order_id = $_POST['order_id'];
$product_id = $_POST['product_id'];
$reason = trim($_POST['reason']);

$stmt = $pdo->prepare("INSERT INTO returns (order_id, product_id, reason) VALUES (?, ?, ?)");
$stmt->execute([$order_id, $product_id, $reason]);

header("Location: ../../views/my_orders.php?status=return_requested");
exit;
