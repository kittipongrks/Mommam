<?php 
session_start();
include ('server.php');

$errors = array();

if (isset($_POST['Edit_Order'])) {
    // รับค่าจากฟอร์ม
    $order_id = $_POST["order_id"];
    $status = $_POST["status"];

    
    // ตรวจสอบว่าผลิตภัณฑ์มีอยู่แล้วหรือไม่
    $orders_check_query = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $query = mysqli_query($conn, $orders_check_query);
    $result = mysqli_fetch_assoc($query);

        if (count($errors) == 0) {
            
                $sql = "UPDATE orders SET 
                        status = '".$_POST["status"]."'
                        WHERE order_id = '$order_id'";
                $query = mysqli_query($conn, $sql);
                header('location: adminpage1.php');
        }
    } 


    // แสดงข้อผิดพลาดหากมี
    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        echo "<script> alert('เกิดข้อผิดพลาด!'); </script>";
        echo "<script> window.location.href='adminpage1.php'; </script>";
    }

?>
