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

// Fetch categories (including parent-child relationships)
$query = "SELECT id, name, parent_id FROM categories ORDER BY parent_id, name";
$stmt = $pdo->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll();

// Fetch parent categories for dropdown
$parentCategories = $pdo->prepare("SELECT id, name FROM categories WHERE parent_id IS NULL");
$parentCategories->execute();
$parentCategoriesList = $parentCategories->fetchAll();

// Handle category deletion
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $deleteStmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $deleteStmt->execute([$deleteId]);
    header("Location: manage-category.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="../assets/css/manage-category.css">
</head>
<body>

<div class="container">
    <h2>Manage Categories</h2>

    <!-- Add Category Form -->
    <form method="POST" action="add-category.php">
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

    <!-- Categories Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Parent Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td><?= $category['parent_id'] ? 'Subcategory' : 'None' ?></td>
                    <td>
                        <a href="edit-category.php?id=<?= $category['id'] ?>" class="edit-btn">Edit</a>
                        <!-- <a href="?delete=<?= $category['id'] ?>" onclick="return confirm('Are you sure you want to delete this category?')" class="delete-btn">Delete</a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
