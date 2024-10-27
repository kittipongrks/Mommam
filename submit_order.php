<?php
session_start();
include 'server.php';
$address = $_SESSION['address'];
$UserID = $_SESSION['UserID'];
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    echo "ไม่มีสินค้าในตะกร้า";
    exit();
}


$total_price = array_sum(array_map(function($item) {
    return $item['price'] * $item['quantity'];
}, $_SESSION['cart']));


$conn->begin_transaction();

try {

    $sql_order = "INSERT INTO orders (order_date, total_amount ,UserID , status, address) VALUES (NOW(), ? , '$UserID' , 'onprocess' , '$address')";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("d", $total_price);
    $stmt_order->execute();
    $order_id = $conn->insert_id; // รับ ID ของ order ที่เพิ่งเพิ่ม


    $sql_item = "INSERT INTO order_items (order_id,product_id, quantity, unit_price) VALUES (?, ?, ?, ?)";
    $stmt_item = $conn->prepare($sql_item);

    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $unit_price = $item['price'];

        
        $stmt_item->bind_param("iiid", $order_id, $product_id, $quantity, $unit_price);
        $stmt_item->execute();
    }

    $_SESSION['cart'] = []; 

    $conn->commit();
    echo "<script> alert('ยืนยันการสั่งซื้อเรียบร้อยแล้ว!'); </script>";
    echo "<script> window.location.href='index.php'; </script>";
    echo "ยืนยันการสั่งซื้อเรียบร้อยแล้ว!";
} catch (Exception $e) {
    $conn->rollback();
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}
$stmt_order->close();
$stmt_item->close();
$conn->close();
?>
