<?php
require_once '../config/db.php';
require_once '../controllers/auth.php';
requireLogin();
$user = currentUser();
$userId = $user['id'];

// Fetch saved addresses
$addrStmt = $pdo->prepare("SELECT * FROM addresses WHERE user_id = ?");
$addrStmt->execute([$userId]);
$addresses = $addrStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch cart items
$cartStmt = $pdo->prepare("
    SELECT ci.id, ci.quantity, p.name, p.price, pm.media_url
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.id
    LEFT JOIN product_media pm ON p.id = pm.product_id AND pm.media_type = 'image'
    WHERE ci.user_id = ?
");
$cartStmt->execute([$userId]);
$cartItems = $cartStmt->fetchAll(PDO::FETCH_ASSOC);
$total = array_sum(array_map(fn($i) => $i['quantity'] * $i['price'], $cartItems));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-inline-group { display: flex; gap: 10px; flex-wrap: wrap; }
        .form-inline-group input { flex: 1 1 150px; }
        .product-thumb { width: 60px; height: 60px; object-fit: cover; margin-right: 10px; }
        .modal .form-control { margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Checkout</h2>

    <form action="../controllers/checkout_process.php" method="POST">
        <div class="mb-4">
            <h5>Select Shipping Address 
                <button type="button" class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#addAddressModal">Add Address</button>
            </h5>
            <select name="shipping_address" class="form-select mb-2" required id="shippingAddress">
                <option value="">-- Select Shipping Address --</option>
                <?php foreach ($addresses as $addr): ?>
                    <?php if ($addr['address_type'] === 'shipping'): ?>
                        <option value="<?= $addr['id'] ?>">
                            <?= htmlspecialchars($addr['address_line'] . ", " . $addr['city'] . ", " . $addr['state'] . " - " . $addr['zip']) ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <h5>Select Billing Address</h5>
            <select name="billing_address" class="form-select" required id="billingAddress">
                <option value="">-- Select Billing Address --</option>
                <?php foreach ($addresses as $addr): ?>
                    <?php if ($addr['address_type'] === 'billing'): ?>
                        <option value="<?= $addr['id'] ?>">
                            <?= htmlspecialchars($addr['address_line'] . ", " . $addr['city'] . ", " . $addr['state'] . " - " . $addr['zip']) ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <h5>Cart Summary</h5>
            <?php foreach ($cartItems as $item): ?>
                <div class="d-flex align-items-center border p-2 mb-2">
                    <img src="../../images/products/<?= htmlspecialchars($item['media_url']) ?>" class="product-thumb" alt="">
                    <div>
                        <strong><?= htmlspecialchars($item['name']) ?></strong><br>
                        ₹<?= number_format($item['price'], 2) ?> × <?= $item['quantity'] ?> = ₹<?= number_format($item['price'] * $item['quantity'], 2) ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="text-end"><strong>Total: ₹<?= number_format($total, 2) ?></strong></div>
        </div>

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>

<!-- Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addAddressForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select name="address_type" class="form-select" required>
            <option value="">-- Select Address Type --</option>
            <option value="shipping">Shipping</option>
            <option value="billing">Billing</option>
        </select>
        <input type="text" name="address_line" class="form-control" placeholder="Address Line" required>
        <div class="form-inline-group">
            <input type="text" name="city" class="form-control" placeholder="City" required>
            <input type="text" name="zip" class="form-control" placeholder="Zip" required>
        </div>
        <div class="form-inline-group">
            <input type="text" name="state" class="form-control" placeholder="State" required>
            <input type="text" name="country" class="form-control" placeholder="Country" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save Address</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('addAddressForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('../controllers/add_address_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const option = document.createElement('option');
            option.value = data.address.id;
            option.text = data.address.display;
            const target = data.address.address_type === 'shipping' ? 'shippingAddress' : 'billingAddress';
            document.getElementById(target).appendChild(option);
            document.getElementById(target).value = data.address.id;
            bootstrap.Modal.getInstance(document.getElementById('addAddressModal')).hide();
        } else {
            alert('Error adding address');
        }
    });
});
</script>
</body>
</html>
