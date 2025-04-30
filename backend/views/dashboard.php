<?php
require_once '../controllers/auth.php';
requireLogin();
$user = currentUser();

if ($user['role'] === 'customer') {
    header("Location: ../../index.php");
    exit;
}

// Dynamic greeting logic
$hour = date("H");
if ($hour < 12) {
    $greeting = "Good Morning";
} elseif ($hour < 18) {
    $greeting = "Good Afternoon";
} else {
    $greeting = "Good Evening";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - <?= ucfirst($user['role']) ?></title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/manage-products.css">
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <h2><?= ucfirst($user['role']) ?> Panel</h2>
            <ul>
                <?php if ($user['role'] === 'admin') : ?>
                    <li><a href="#" onclick="loadContent('manage_users')">Manage Users</a></li>
                    <li><a href="#" onclick="loadContent('manage-category')">Manage Catgeory</a></li>
                    <li><a href="#" onclick="loadContent('manage-products')">Manage Products</a></li>
                    <li><a href="#" onclick="loadContent('manage_orders')">Manage Orders</a></li>
                    <li><a href="#" onclick="loadContent('manage_hero_images')">Manage hero banner</a></li>

                    <li><a href="#" onclick="loadContent('view-reports')">View Reports</a></li>
                <?php elseif ($user['role'] === 'vendor') : ?>
                    <li><a href="#" onclick="loadContent('manage-my-products')">My Products</a></li>
                    <li><a href="#" onclick="loadContent('view-my-orders')">My Orders</a></li>
                <?php endif; ?>
            </ul>
        </aside>

        <main class="main">
            <header class="dashboard-header">
                <div class="greeting"><?= $greeting ?>, <?= htmlspecialchars($user['name']) ?> 👋</div>
                <a href="../controllers/auth.php?logout=true" class="logout-btn">Logout</a>

            </header>
            <section id="content-area">
                <p>Welcome to your dashboard. Select an option from the left menu.</p>
            </section>
        </main>
    </div>

    <script src="admin.js?v=<?= time() ?>"></script>

</body>

</html>