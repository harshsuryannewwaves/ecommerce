<?php
require_once '../config/db.php';
require_once '../controllers/auth.php';
requireLogin();

$user = currentUser();
$userId = $user['id'];

// Handle form submission for adding a new address
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['address_type'];
    $line = $_POST['address_line'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    if ($type && $line && $city && $zip && $state && $country) {
        $stmt = $pdo->prepare("INSERT INTO addresses (user_id, address_type, address_line, city, zip, state, country) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $type, $line, $city, $zip, $state, $country]);
        header("Location: address.php?success=1");
        exit;
    }
}

// Fetch existing addresses
$stmt = $pdo->prepare("SELECT * FROM addresses WHERE user_id = ?");
$stmt->execute([$userId]);
$addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Addresses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .address-card { margin-bottom: 20px; }
        .form-section { background: #f9f9f9; padding: 20px; border-radius: 6px; }
        .compact-input input, .compact-input select {
            margin-bottom: 10px;
        }
        .compact-input .row > div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="container my-5">
    <h2 class="mb-4">📦 My Addresses</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Address added successfully!</div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-7">
            <h5 class="mb-3">Saved Addresses</h5>
            <?php if (count($addresses) > 0): ?>
                <?php foreach ($addresses as $addr): ?>
                    <div class="card address-card">
                        <div class="card-body">
                            <h6 class="card-title"><?= ucfirst($addr['address_type']) ?> Address</h6>
                            <p class="card-text mb-1"><?= htmlspecialchars($addr['address_line']) ?></p>
                            <p class="card-text mb-0">
                                <?= htmlspecialchars($addr['city']) ?>, 
                                <?= htmlspecialchars($addr['state']) ?>, 
                                <?= htmlspecialchars($addr['zip']) ?>, 
                                <?= htmlspecialchars($addr['country']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No addresses found.</p>
            <?php endif; ?>
        </div>

        <div class="col-md-5">
            <h5 class="mb-3">Add New Address</h5>
            <form method="POST" class="form-section">
                <div class="mb-2">
                    <label for="address_type" class="form-label">Address Type</label>
                    <select name="address_type" class="form-select" required>
                        <option value="">Select</option>
                        <option value="shipping">Shipping</option>
                        <option value="billing">Billing</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label for="address_line" class="form-label">Address Line</label>
                    <textarea name="address_line" class="form-control" rows="2" required></textarea>
                </div>

                <div class="row compact-input">
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">ZIP Code</label>
                        <input type="text" name="zip" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Add Address</button>
            </form>
        </div>
    </div>
</body>
</html>
