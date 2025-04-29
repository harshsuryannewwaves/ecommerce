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

// Fetch category details to edit
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("SELECT id, name, parent_id FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    $category = $stmt->fetch();
} else {
    echo "<p>Category not found.</p>";
    exit;
}

// Fetch parent categories for dropdown
$parentCategories = $pdo->prepare("SELECT id, name FROM categories WHERE parent_id IS NULL");
$parentCategories->execute();
$parentCategoriesList = $parentCategories->fetchAll();

// Handle category update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'] ?: null;

    // Update category in the database
    $stmt = $pdo->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
    $stmt->execute([$name, $parent_id, $id]);

    // Redirect to manage categories page
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="../assets/css/manage-category.css">
</head>
<body>

<div class="container">
    <h2>Edit Category</h2>

    <form method="POST">
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($category['name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" id="parent_id">
                <option value="">None</option>
                <?php foreach ($parentCategoriesList as $parentCategory): ?>
                    <option value="<?= $parentCategory['id'] ?>" <?= $category['parent_id'] == $parentCategory['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($parentCategory['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn">Update Category</button>
    </form>
</div>

</body>
</html>
