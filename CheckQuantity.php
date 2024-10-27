<?php 
session_start();
include ('server.php'); // การเชื่อมต่อฐานข้อมูล

$errors = array();
foreach ($_SESSION['cart'] as $item) {
    $product_id = $item["product_id"];
    $OrderQuantity = $item['quantity'];
}
    
    // ตรวจสอบจำนวนสินค้าที่เหลืออยู่ใน products
    $product_check_query = "SELECT * FROM products WHERE product_id = '$product_id'";
    $product_result = mysqli_query($conn, $product_check_query);
    
    if (mysqli_num_rows($product_result) > 0) {
        $product = mysqli_fetch_assoc($product_result);
        $current_stock = (int)$product['stock_quantity'];

        // ตรวจสอบว่า stock_quantity เพียงพอหรือไม่
        if ($current_stock >= $OrderQuantity) {
            // ลดค่าในตาราง quantity Products
            $current_stock = $current_stock - $OrderQuantity;
        
            // เตรียมคำสั่ง SQL ด้วยการป้องกัน SQL Injection
            $stmt = $conn->prepare("UPDATE products SET stock_quantity = ? WHERE product_id = ?");
            $stmt->bind_param("ii", $current_stock, $product_id);
        
            // รันคำสั่ง SQL และตรวจสอบผลลัพธ์
            if ($stmt->execute()) {
                // ถ้าจำนวนสินค้าเพียงพอ ทำการเพิ่มคำสั่งซื้อในตาราง orders
                header('location: submit_order.php');
                exit(); // หยุดการทำงานต่อหลังจาก redirect
            } else {
                array_push($errors, "Failed to update stock.");
            }
        
            // ปิด statement
            $stmt->close();
        } else {
            // ถ้าจำนวนสินค้าไม่พอ แสดงข้อผิดพลาด
            echo "<script> alert('Not enough stock available for this product.!'); </script>";
            echo "<script> window.location.href='index.php'; </script>";
        }
    } else {
        echo "<script> alert('Product not found.!'); </script>";
        echo "<script> window.location.href='index.php'; </script>";
    }

    // แสดงข้อผิดพลาดหากมี
    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        header('location: index.php');
        exit();
    }



?>