<?php
session_start();
require_once "../../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../../views/auth/login.php");
    exit;
}

$wishlist_id = $_POST['wishlist_id'];
$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("DELETE FROM wishlist WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $wishlist_id, 'user_id' => $user_id]);

header("Location: ../../views/wishlist.php");
exit;
?>
