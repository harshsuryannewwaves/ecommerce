<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $orderId = intval($_POST['order_id']);
    $status = $_POST['status'];
    $allowed = ['Pending', 'Shipped', 'Delivered', 'Cancelled', 'Refunded'];

    if (in_array($status, $allowed)) {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        if ($stmt->execute([$status, $orderId])) {
            echo "<p style='color:green;'>Order #$orderId status updated to $status.</p>";
        } else {
            echo "<p style='color:red;'>Failed to update status for Order #$orderId. Please try again.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid status selected.</p>";
    }
} else {
    echo "<p style='color:red;'>Invalid request.</p>";
}
