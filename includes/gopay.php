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

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $amount = $_POST['amount'] ?? '';
    $merchant = $_POST['merchant'] ?? '';
    $affiliated_merchants = ["Starbucks", "Shopee", "Grab"];
    if(in_array($merchant, $affiliated_merchants)){
        $_SESSION['points'] += floor($amount * $merchant_multipliers[$merchant]);
    } 
}
header("Location: ../gopay.html");
?>