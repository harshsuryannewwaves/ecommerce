<?php
// session_start();
require_once '../config/db.php';
require_once '../controllers/auth.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header("Location: ./backend/views/auth/login.php");
    exit;
}

$user = currentUser();
$userId = $user['id'];

// Fetch cart items
$stmt = $pdo->prepare("
    SELECT 
        ci.id AS cart_id,
        p.name AS product_name,
        p.price,
        pv.attribute_name,
        pv.attribute_value,
        ci.quantity,
        pm.media_url AS image
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.id
    LEFT JOIN product_variants pv ON ci.variant_id = pv.id
    LEFT JOIN product_media pm ON pm.product_id = p.id AND pm.media_type = 'image'
    WHERE ci.user_id = ?
    GROUP BY ci.id
");
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/cart.css">
</head>
<body>
<div class="container my-5">
  <h2 class="mb-4">🛒 Your Cart</h2>

  <?php if (count($cartItems) > 0): ?>
    <table class="table table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>Product</th>
          <th>Variant</th>
          <th>Price (₹)</th>
          <th>Quantity</th>
          <th>Subtotal (₹)</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($cartItems as $item): ?>
        <tr>
          <td>
            <img src="../../images/products/<?= htmlspecialchars($item['image']) ?>" class="product-thumb" alt="Product" height="100">
            <?= htmlspecialchars($item['product_name']) ?>
          </td>
          <td>
            <?= $item['attribute_name'] ? "{$item['attribute_name']}: {$item['attribute_value']}" : 'Default' ?>
          </td>
          <td><?= number_format($item['price'], 2) ?></td>
          <td>
            <form action="../controllers/cartController.php" method="POST" class="d-inline">
              <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
              <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="form-control form-control-sm quantity-input">
              <button type="submit" name="update" class="btn btn-sm btn-outline-primary mt-1">Update</button>
            </form>
          </td>
          <td><?= number_format($item['price'] * $item['quantity'], 2) ?></td>
          <td>
            <form action="../controllers/cartController.php" method="POST">
              <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
              <button type="submit" name="delete" class="btn btn-sm btn-outline-danger">Remove</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-end">
      <h5>Total: ₹<?= number_format($total, 2) ?></h5>
    </div>
    <div class="text-end mt-3">
      <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
    </div>
  <?php else: ?>
    <p>Your cart is empty.</p>
    <a href="../../index.php" class="btn btn-primary mt-3">Continue Shopping</a>
  <?php endif; ?>
</div>
</body>
</html>
