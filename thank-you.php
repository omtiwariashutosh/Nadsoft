<?php
session_start();
require 'config.php';

if (!isset($_SESSION['member_id'])) {
    echo "<h3 class='text-danger text-center'>Session expired. Please try again.</h3>";
    exit;
}

$memberId = $_SESSION['member_id'];

// Fetch all products ordered by the member
$sql = "SELECT product, price FROM member_orders WHERE member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $memberId);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
$total = 0;

while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
    $total += $row['price'];
}

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Thank You - NadSoft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/upsell.css">
</head>

<body>

    <div class="container py-5">
        <main>
            <div class="text-center mb-4">
                <img src="assets/img/favicon.png" alt="Logo" width="72" height="72">
                <h2 class="mt-3" style="font-family: '';">Thank You for Your Order!</h2>
                <p class="lead">Your purchase was successful. Here’s a summary of what you bought:</p>
            </div>

            <?php if (count($orders) > 0): ?>
                <div class="card shadow p-4">
                    <ul class="list-group mb-3">
                        <?php foreach ($orders as $order): ?>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?= htmlspecialchars($order['product']) ?></h6>
                                </div>
                                <span class="text-muted">₹<?= number_format($order['price'], 2) ?></span>
                            </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total (INR)</strong>
                            <strong>₹<?= number_format($total, 2) ?></strong>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    No products were found in your order.
                </div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="index.html" class="btn btn-dark"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
            </div>
        </main>
    </div>

</body>

</html>