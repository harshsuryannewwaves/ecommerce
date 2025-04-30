<?php
require_once '../config/db.php';

$stmt = $pdo->prepare("SELECT p.*, pm.media_url 
                       FROM products p 
                       LEFT JOIN product_media pm ON p.id = pm.product_id AND pm.media_type = 'image' 
                       WHERE p.is_deleted = 0");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($products);
?>
