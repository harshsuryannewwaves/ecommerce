<?php
require_once '../controllers/auth.php';
requireLogin();
$user = currentUser();

if ($user['role'] !== 'admin') {
    echo "<p>Access Denied.</p>";
    exit;
}

require_once '../config/db.php';

// Handle AJAX status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status']) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
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
    exit; // stop script to prevent full page from rendering on AJAX call
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
<h2 style="margin-top: 40px;">Return Requests</h2>

<?php
require_once '../config/db.php'; // adjust as needed

// ✅ Handle status update first
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['return_id'], $_POST['return_status'])) {
    $returnId = intval($_POST['return_id']);
    $newStatus = $_POST['return_status'];
    $allowedStatuses = ['approved', 'rejected', 'refunded'];

    if (in_array($newStatus, $allowedStatuses)) {
        $stmt = $pdo->prepare("UPDATE returns SET status = ? WHERE id = ?");
        if ($stmt->execute([$newStatus, $returnId])) {
            $message = "<p style='color:green;'>Return #$returnId status updated to $newStatus.</p>";
        } else {
            $message = "<p style='color:red;'>Failed to update return status. Please try again.</p>";
        }
    } else {
        $message = "<p style='color:red;'>Invalid return status selected.</p>";
    }
}

// ✅ Then fetch updated return records
$returnStmt = $pdo->query("
    SELECT r.*, 
           p.name AS product_name, 
           u.name AS customer_name,
           o.created_at AS order_date
    FROM returns r
    JOIN orders o ON r.order_id = o.id
    JOIN products p ON r.product_id = p.id
    JOIN users u ON o.user_id = u.id
    ORDER BY r.id DESC
");

$returns = $returnStmt->fetchAll();
?>


<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; background: white;">
    <thead style="background:#f3f4f6;">
        <tr>
            <th>Return ID</th>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Reason</th>
            <th>Requested At</th>
            <th>Status</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($returns as $return): ?>
            <tr>
                <td><?= $return['id'] ?></td>
                <td><?= $return['order_id'] ?></td>
                <td><?= htmlspecialchars($return['customer_name']) ?></td>
                <td><?= htmlspecialchars($return['product_name']) ?></td>
                <td><?= nl2br(htmlspecialchars($return['reason'])) ?></td>
                <td><?= date("d M Y, h:i A", strtotime($return['created_at'] ?? $return['order_date'])) ?></td>
                <td><?= ucfirst($return['status']) ?></td>
                <td>
                    <?php if ($return['status'] === 'requested'): ?>
                        <form id="return-status-form-<?= $return['id'] ?>" style="display:inline;">
                            <input type="hidden" name="return_id" value="<?= $return['id'] ?>">
                            <select name="return_status" onchange="updateReturnStatus(<?= $return['id'] ?>)">
                                <option value="">--Change Status--</option>
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                                <option value="refunded">Refund</option>
                            </select>
                        </form>
                        <div id="return-msg-<?= $return['id'] ?>"></div>
                    <?php else: ?>
                        <em>No action</em>
                    <?php endif; ?>


                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    function updateStatus(orderId) {
        const form = document.querySelector(`#status-form-${orderId}`);
        const formData = new FormData(form);

        fetch('manage_orders.php', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.text())
            .then(responseText => {
                const msgBox = document.createElement('div');
                msgBox.innerHTML = responseText;
                msgBox.style.marginTop = '10px';
                form.parentElement.appendChild(msgBox);
                setTimeout(() => {
                    msgBox.remove();
                }, 3000);
            })
            .catch(error => console.error('Error:', error));
    }
</script>