<?php
require_once '../config/db.php';
require_once 'auth.php';
requireLogin();
$user = currentUser();
$userId = $user['id'];
$payment_status="paid";
$shipping = $_POST['shipping_address'];
$billing = $_POST['billing_address'];

if (!$shipping || !$billing) {
    die("Address not selected.");
}

// Fetch cart items
$stmt = $pdo->prepare("
    SELECT ci.product_id, ci.quantity, pv.id AS variant_id, COALESCE(pv.price, p.price) AS price
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.id
    LEFT JOIN product_variants pv ON ci.variant_id = pv.id
    WHERE ci.user_id = ?
");
$stmt->execute([$userId]);
$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($cart)) die("Cart is empty.");

// Calculate total
$total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

try {
    $pdo->beginTransaction();

    // Insert order
    $orderStmt = $pdo->prepare("
        INSERT INTO orders (user_id, total, payment_status,shipping_address_id, billing_address_id)
        VALUES (?, ?,?, ?, ?)
    ");
    $orderStmt->execute([$userId, $total,$payment_status ,$shipping, $billing]);
    $orderId = $pdo->lastInsertId();

    // Insert order items
    $itemStmt = $pdo->prepare("
        INSERT INTO order_items (order_id, product_id, variant_id, quantity, price)
        VALUES (?, ?, ?, ?, ?)
    ");

    foreach ($cart as $item) {
        $itemStmt->execute([
            $orderId,
            $item['product_id'],
            $item['variant_id'] ?? null,
            $item['quantity'],
            $item['price']
        ]);
    }

    // Insert transaction (dummy for now)
    $txnStmt = $pdo->prepare("
        INSERT INTO transactions (user_id, order_id, payment_gateway, transaction_id, status, amount)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $txnStmt->execute([
        $userId,
        $orderId,
        'dummy_gateway',
        uniqid('txn_'), // simulate transaction ID
        'success',      // simulate success
        $total
    ]);

    // Clear cart
    $pdo->prepare("DELETE FROM cart_items WHERE user_id = ?")->execute([$userId]);

    $pdo->commit();

    // Redirect to order success page
    header("Location: ../views/order_success.php?order_id=" . $orderId);
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    die("Order failed: " . $e->getMessage());
}
