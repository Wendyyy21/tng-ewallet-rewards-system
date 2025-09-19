<?php
session_start();

$vouchers = [
    1 => 500,  
    2 => 300,  
    3 => 800,  
    4 => 450,  
    5 => 600,  
    6 => 400,  
    7 => 1200, 
    8 => 700,  
    9 => 250,  
    10 => 900, 
    11 => 200, 
    12 => 550, 
];

if(!isset($_SESSION['points'])) {
    $_SESSION['points'] = 0;
}

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $voucher_id = isset($_POST['voucher_id']) ? intval($_POST['voucher_id']) : 0;

    if(isset($vouchers[$voucher_id])) {     // if voucher is valid
        $voucher_cost = $vouchers[$voucher_id];
        if($_SESSION['points'] >= $voucher_cost) {  // if user has sufficient points
            $_SESSION['points'] -= $voucher_cost;
            echo json_encode([
                "success" => true,
                "message" => "Voucher redeemed successfully!",
                "points" => $_SESSION['points']
            ]);
        } else {    // if not enough points
            echo json_encode([
                "success" => false,
                "message" => "Insufficient points!",
                "points" => $_SESSION['points']
            ]);
        }
    } else {    // if invalid voucher, show error message
        echo json_encode([
            "success" => false,
            "message" => "Invalid voucher ID: " . htmlspecialchars($_POST['voucher_id']),
            "points" => $_SESSION['points']
        ]);
    }
    exit;
} else {
    echo json_encode(['points' => $_SESSION['points']]);
    exit;
}
?>