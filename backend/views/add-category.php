<?php
require_once '../config/db.php';
require_once '../controllers/auth.php';
requireLogin();
$user = currentUser();

// Check if the user is an admin
if ($user['role'] !== 'admin') {
  echo "<p>Access Denied.</p>";
  exit;
}

// Handle category addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'] ?: null;

    // Insert category into the database
    $stmt = $pdo->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
    $stmt->execute([$name, $parent_id]);

    // Redirect to manage categories page
    header("Location: dashboard.php");
    exit;
}

// Fetch parent categories for dropdown
$parentCategories = $pdo->prepare("SELECT id, name FROM categories WHERE parent_id IS NULL");
$parentCategories->execute();
$parentCategoriesList = $parentCategories->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="../assets/css/manage-category.css">
</head>
<body>

<div class="container">
    <h2>Add Category</h2>

    <form method="POST">
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" id="parent_id">
                <option value="">None</option>
                <?php foreach ($parentCategoriesList as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn">Add Category</button>
    </form>
</div>

</body>
</html>
