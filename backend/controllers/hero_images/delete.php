<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
    exit('Unauthorized');
}

$id = $_POST['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("SELECT image_url FROM hero_images WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $img = $stmt->fetch();

    if ($img && file_exists("../../" . $img['image_url'])) {
        unlink("../../" . $img['image_url']);
    }

    $stmt = $pdo->prepare("DELETE FROM hero_images WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header("Location: ../../views/dashboard.php");
exit;
