<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the user ID from the URL

    // Prepare and execute the delete statement
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $deleted = $stmt->execute([$id]);

    if ($deleted) {
        // Redirect back to the user management page (or wherever you need to go)
        header("Location: ../views/dashboard.php"); // Adjust this URL to your admin panel page
        exit;
    } else {
        // Handle errors if the deletion fails
        echo "Failed to delete user.";
    }
} else {
    echo "Invalid request.";
}
?>
