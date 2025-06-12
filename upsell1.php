<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['member_id'])) {
    echo json_encode(['success' => false, 'message' => 'Session expired']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $product = $data['product'] ?? '';
    $price = $data['price'] ?? 0;
    $userId = $_SESSION['member_id'];

    if (empty($product) || $price <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
        exit;
    }

    require 'config.php';

    $stmt = $conn->prepare("INSERT INTO member_orders (member_id, product, price) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $userId, $product, $price);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'DB error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
