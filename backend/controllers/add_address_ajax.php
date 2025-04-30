<?php
require_once '../config/db.php';
require_once 'auth.php';
header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false]);
    exit;
}

$user = currentUser();
$userId = $user['id'];

$type = $_POST['address_type'];
$line = $_POST['address_line'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$state = $_POST['state'];
$country = $_POST['country'];

$stmt = $pdo->prepare("INSERT INTO addresses (user_id, address_type, address_line, city, zip, state, country) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$userId, $type, $line, $city, $zip, $state, $country]);

$addressId = $pdo->lastInsertId();
$display = "$line, $city, $state - $zip";

echo json_encode(['success' => true, 'address' => ['id' => $addressId, 'display' => $display, 'address_type' => $type]]);
