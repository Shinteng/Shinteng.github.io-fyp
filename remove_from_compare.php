<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $product_id = intval($_POST['product_id']);

    if (isset($_SESSION['compare_list'])) {
        $_SESSION['compare_list'] = array_diff($_SESSION['compare_list'], [$product_id]);
    }

    echo json_encode(['status' => 'success']);
}
?>
