<?php
require_once '../controllers/auth.php';
requireLogin();
$user = currentUser();

if ($user['role'] !== 'admin') {
    echo "<p>Access Denied.</p>";
    exit;
}

require_once '../config/db.php'; // This gives you $pdo

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $orderId = intval($_POST['order_id']);
    $status = $_POST['status'];
    $allowed = ['Pending', 'Shipped', 'Delivered', 'Cancelled', 'Refunded'];

    if (in_array($status, $allowed)) {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        if ($stmt->execute([$status, $orderId])) {
            echo "<p style='color:green;'>Order #$orderId status updated to $status.</p>";
        } else {
            echo "<p style='color:red;'>Failed to update status for Order #$orderId. Please try again.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid status selected.</p>";
    }
}

// Fetch all orders
$stmt = $pdo->query("
    SELECT 
        o.*, 
        u.name AS customer_name,
        sa.address_line AS shipping_address,
        sa.city AS shipping_city,
        sa.state AS shipping_state,
        sa.zip AS shipping_zip,
        ba.address_line AS billing_address,
        ba.city AS billing_city,
        ba.state AS billing_state,
        ba.zip AS billing_zip
    FROM orders o
    JOIN users u ON o.user_id = u.id
    LEFT JOIN addresses sa ON o.shipping_address_id = sa.id
    LEFT JOIN addresses ba ON o.billing_address_id = ba.id
    ORDER BY o.created_at DESC
");

$orders = $stmt->fetchAll();
?>

<h2>Manage Orders</h2>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; background: white;">
    <thead style="background:#f3f4f6;">
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Shipping Address</th>
            <th>Billing Address</th>
            <th>Total</th>
            <th>Status</th>
            <th>Ordered At</th>
            <th>Items</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['customer_name']) ?></td>
            <td>
    <?= nl2br(htmlspecialchars(
        $order['shipping_address'] . ", " .
        $order['shipping_city'] . ", " .
        $order['shipping_state'] . " - " .
        $order['shipping_zip']
    )) ?>
</td>

<td>
    <?= nl2br(htmlspecialchars(
        $order['billing_address'] . ", " .
        $order['billing_city'] . ", " .
        $order['billing_state'] . " - " .
        $order['billing_zip']
    )) ?>
</td>

            <td>₹<?= number_format($order['total'], 2) ?></td>
            <td>
    <form id="status-form-<?= $order['id'] ?>" method="POST" style="display:inline;">
        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
        <select name="status" onchange="updateStatus(<?= $order['id'] ?>)">
            <?php
            $statuses = ['Pending', 'Shipped', 'Delivered', 'Cancelled', 'Refunded'];
            foreach ($statuses as $status) {
                $selected = (strtolower($order['status']) === strtolower($status)) ? 'selected' : '';
                echo "<option value='$status' $selected>$status</option>";
            }
            ?>
        </select>
    </form>
</td>
            <td><?= date("d M Y, h:i A", strtotime($order['created_at'])) ?></td>
            <td>
                <?php
                $itemStmt = $pdo->prepare("
                    SELECT p.name, oi.quantity 
                    FROM order_items oi 
                    JOIN products p ON p.id = oi.product_id 
                    WHERE oi.order_id = ?
                ");
                $itemStmt->execute([$order['id']]);
                $items = $itemStmt->fetchAll();

                foreach ($items as $item) {
                    echo "<div>" . htmlspecialchars($item['name']) . " × " . $item['quantity'] . "</div>";
                }
                ?>
            </td>
            <td>
                <?php if ($order['status'] === 'Delivered'): ?>
                    <a href="?order_id=<?= $order['id'] ?>&status=Refunded" onclick="return confirm('Refund this order?')">Refund</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
    function updateStatus(orderId) {
        // Get the selected status value
        var status = document.querySelector(`#status-form-${orderId} select[name="status"]`).value;
        
        // Create a new FormData object to hold the form data
        var formData = new FormData();
        formData.append('order_id', orderId);
        formData.append('status', status);
        
        // Send the data using fetch API (AJAX)
        fetch('path_to_this_php_file.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(responseText => {
            // Optionally, update the status text on the page
            document.querySelector(`#status-form-${orderId} select[name="status"]`).parentElement.innerHTML = responseText;
        })
        .catch(error => console.error('Error:', error));
    }
</script>
