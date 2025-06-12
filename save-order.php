<?php
session_start();
require 'config.php';

$firstName      = $_POST['firstName'];
$lastName       = $_POST['lastName'];
$username       = $_POST['username'];
$email          = $_POST['email'];
$address        = $_POST['address'];
$address2       = $_POST['address2'];
$country        = $_POST['country'];
$state          = $_POST['state'];
$zip            = $_POST['zip'];
$paymentMethod  = $_POST['paymentMethod'];
$cardName       = $_POST['cardName'];
$cardNumber     = $_POST['cardNumber'];
$cardExpiration = $_POST['cardExpiration'];
$cardCVV        = $_POST['cardCVV'];

$stmt = $conn->prepare("INSERT INTO members (first_name, last_name, username, email, address, address2, country, state, zip, payment_method, card_name, card_number, card_expiration, card_cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssss", $firstName, $lastName, $username, $email, $address, $address2, $country, $state, $zip, $paymentMethod, $cardName, $cardNumber, $cardExpiration, $cardCVV);

if ($stmt->execute()) {
    $member_id = $stmt->insert_id;

    $_SESSION['member_id'] = $conn->insert_id;
    $_SESSION['products'] = [
        ["name" => "Main Product", "price" => 299]
    ];

    $product = "Main Product";
    $price = 299;

    $order_stmt = $conn->prepare("INSERT INTO member_orders (member_id, product, price) VALUES (?, ?, ?)");
    $order_stmt->bind_param("isi", $member_id, $product, $price);
    $order_stmt->execute();

    header("Location: upsell1.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
