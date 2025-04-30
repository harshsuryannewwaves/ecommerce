<?php
require_once '../config/db.php';
require_once '../controllers/auth.php';
requireLogin();

$orderId = $_GET['order_id'] ?? null;
if (!$orderId) {
    echo "Invalid order.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Successful</title>
    <meta http-equiv="refresh" content="3;url=../../index.php">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="alert alert-success text-center">
        <h4 class="alert-heading">🎉 Thank you for your purchase!</h4>
        <p>Your order (ID: <strong>#<?= htmlspecialchars($orderId) ?></strong>) was placed successfully.</p>
        <p>You will be redirected to the homepage shortly...</p>
    </div>
</body>
</html>
