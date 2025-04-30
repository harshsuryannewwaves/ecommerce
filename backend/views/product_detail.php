<?php
session_start();
require_once '../config/db.php';

$product_id = $_GET['id'] ?? null;
if (!$product_id) {
    echo "Product ID missing.";
    exit;
}

// Fetch product details
$stmt = $pdo->prepare("SELECT p.*, c.name AS category_name FROM products p 
                       LEFT JOIN categories c ON p.category_id = c.id 
                       WHERE p.id = ? AND p.is_deleted = 0");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found.";
    exit;
}

// Fetch media
$mediaStmt = $pdo->prepare("SELECT * FROM product_media WHERE product_id = ? AND media_type = 'image'");
$mediaStmt->execute([$product_id]);
$media = $mediaStmt->fetchAll();

// Fetch variants
$variantStmt = $pdo->prepare("SELECT * FROM product_variants WHERE product_id = ?");
$variantStmt->execute([$product_id]);
$variants = $variantStmt->fetchAll();

// Fetch reviews
$reviewStmt = $pdo->prepare("SELECT r.*, u.name FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = ?");
$reviewStmt->execute([$product_id]);
$reviews = $reviewStmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($product['name']) ?></title>
    <link rel="stylesheet" href="../assets/css/product_detail.css">
</head>
<body>
    <div class="product-detail-container">
        <div class="media">
            <?php if ($media): ?>
                <img src="images/products/<?= $media[0]['media_url'] ?>" alt="<?= $product['name'] ?>">
            <?php else: ?>
                <img src="images/default.jpg" alt="No image">
            <?php endif; ?>
        </div>
        <div class="details">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p class="category">Category: <?= htmlspecialchars($product['category_name']) ?></p>
            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <p class="price">$<?= $product['price'] ?></p>
            <p class="stock"><?= $product['stock'] > 0 ? "In Stock: {$product['stock']}" : "Out of Stock" ?></p>

            <?php if ($variants): ?>
                <form action="../controllers/cart/cart_add.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                    <label>Select Variant:</label>
                    <select name="variant_id" required>
                        <?php foreach ($variants as $v): ?>
                            <option value="<?= $v['id'] ?>">
                                <?= $v['attribute_name'] ?>: <?= $v['attribute_value'] ?> ($<?= $v['price'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            <?php else: ?>
                <form action="../controllers/cart/cart_add.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                    <input type="number" name="quantity" value="1" min="1" max="10">
                    <button type="submit">Add to Cart</button>
                </form>
            <?php endif; ?>

            <form action="../controllers/wishlist/add.php" method="POST" style="margin-top: 10px;">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <button type="submit">Add to Wishlist ❤️</button>
            </form>
        </div>
    </div>

    <div class="review-section">
        <h3>Reviews</h3>
        <?php if ($reviews): ?>
            <?php foreach ($reviews as $r): ?>
                <div class="review">
                    <strong><?= htmlspecialchars($r['name']) ?></strong>
                    <span>Rating: <?= str_repeat("⭐", $r['rating']) ?></span>
                    <p><?= nl2br(htmlspecialchars($r['comment'])) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No reviews yet.</p>
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])): ?>
            <form action="controllers/reviews/submit_review.php" method="POST" class="review-form">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <label>Rating:
                    <select name="rating" required>
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <option value="<?= $i ?>"><?= $i ?> Star<?= $i > 1 ? 's' : '' ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
                <textarea name="comment" placeholder="Write your review..." required></textarea>
                <button type="submit">Submit Review</button>
            </form>
        <?php else: ?>
            <p><a href="login.php">Login to submit a review</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
