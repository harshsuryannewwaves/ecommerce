<?php
require_once '../config/db.php'; // adjust path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['return_id'], $_POST['return_status'])) {
    $returnId = intval($_POST['return_id']);
    $newStatus = $_POST['return_status'];
    $allowedStatuses = ['approved', 'rejected', 'refunded'];

    if (in_array($newStatus, $allowedStatuses)) {
        $stmt = $pdo->prepare("UPDATE returns SET status = ? WHERE id = ?");
        if ($stmt->execute([$newStatus, $returnId])) {
            echo "<span style='color:green;'>Status updated to $newStatus.</span>";
        } else {
            echo "<span style='color:red;'>Failed to update status.</span>";
        }
    } else {
        echo "<span style='color:red;'>Invalid status selected.</span>";
    }
} else {
    echo "<span style='color:red;'>Invalid request.</span>";
}
