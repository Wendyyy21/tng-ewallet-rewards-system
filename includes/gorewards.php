<?php
session_start();

if(!isset($_SESSION['points'])) {
    $_SESSION['points'] = 0;
}

echo json_encode(['points' => $_SESSION['points']]);

?>