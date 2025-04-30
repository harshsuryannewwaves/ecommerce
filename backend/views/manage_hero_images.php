<?php
session_start();
require_once '../config/db.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM hero_images ORDER BY created_at DESC");
$images = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Hero Images</title>
    <link rel="stylesheet" href="../assets/css/manage-products.css">
</head>
<body>
    <h2>Manage Hero Slider Images</h2>

    <form action="../controllers/hero_images/upload.php" method="POST" enctype="multipart/form-data">
        <label>Upload New Image:</label>
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>

    <hr>
    <div class="image-list">
        <?php foreach ($images as $img): ?>
            <div style="margin-bottom: 10px;">
                <img src="../<?= $img['image_url'] ?>" width="200">
                <form method="POST" action="../controllers/hero_images/delete.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $img['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
