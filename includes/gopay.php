<?php

session_start();

$merchant_multipliers = [
    "Starbucks" => 1,
    "Shopee" => 2,
    "Grab" => 3
];

if(!isset($_SESSION['points'])) {
    $_SESSION['points'] = 0;
}

$points_earned = 0;

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $amount = $_POST['amount'] ?? '';
    $merchant = $_POST['merchant'] ?? '';
    $affiliated_merchants = ["Starbucks", "Shopee", "Grab"];
    if(in_array($merchant, $affiliated_merchants)){
        $points_earned = floor($amount * $merchant_multipliers[$merchant]);
        $_SESSION['points'] += $points_earned;
    } 

    echo json_encode([
        "success" => true,
        "points_earned" => $points_earned,
    ]);
    exit;
}
?>