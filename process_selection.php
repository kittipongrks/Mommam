<?php
session_start();
include 'server.php';

if (isset($_POST['product_id'], $_POST['product_name'], $_POST['price'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // ตรวจสอบว่ามีสินค้านี้อยู่ในตะกร้าแล้วหรือไม่
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += 1; // ถ้ามีสินค้าอยู่แล้ว เพิ่ม quantity
            $found = true;
            break;
        }
    }

    // ถ้าไม่มีสินค้านี้ในตะกร้า ให้เพิ่มสินค้าลงไปและตั้งค่า quantity เป็น 1
    if (!$found) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => 1
        ];
    }
    
    
    header("Location: " . $_SESSION['PAGE']);
    exit();
}
?>
