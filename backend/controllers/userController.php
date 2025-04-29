<?php
require_once '../config/db.php';

function handleUserRequest() {
    global $pdo;

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        header('Content-Type: application/json');
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
        }
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id    = $_POST['id'];
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $role  = $_POST['role'];

        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
        $updated = $stmt->execute([$name, $email, $role, $id]);

        header('Content-Type: application/json');
        echo json_encode(['success' => $updated]);
        return;
    }

    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}

handleUserRequest();
