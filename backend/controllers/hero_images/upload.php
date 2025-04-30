<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
    exit('Unauthorized');
}

if (!empty($_FILES['image']['name'])) {
    $targetDir = "../../images/hero/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $filename = basename($_FILES['image']['name']);
    $targetFile = $targetDir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $relativePath = str_replace("../../", "", $targetFile);
        $stmt = $pdo->prepare("INSERT INTO hero_images (image_url) VALUES (:image_url)");
        $stmt->execute(['image_url' => $relativePath]);
        header("Location: ../../views/dashboard.php");
        exit;
    }
}
header("Location: ../../views/manage_hero_images.php?error=1");
exit;
