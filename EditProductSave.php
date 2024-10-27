<?php 
session_start();
include ('server.php');

$errors = array();

if (isset($_POST['Edit_products'])) {
    // รับค่าจากฟอร์ม
    $ProductName = mysqli_real_escape_string($conn, $_POST["ProductName"]);
    $ProductID = $_POST["product_id"];

    $imageProduct = basename($_FILES["image"]["name"]);
    
    // ตรวจสอบว่าผลิตภัณฑ์มีอยู่แล้วหรือไม่
    $products_check_query = "SELECT * FROM products WHERE product_name = '$ProductName' AND product_id = '$ProductID'";
    $query = mysqli_query($conn, $products_check_query);
    $result = mysqli_fetch_assoc($query);


    // ตรวจสอบไฟล์รูปภาพที่อัปโหลด
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['product_image']['name'];
        $image_tmp_name = $_FILES['product_image']['tmp_name'];
        $image_size = $_FILES['product_image']['size'];
        $image_error = $_FILES['product_image']['error'];

        // ตรวจสอบนามสกุลไฟล์
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
        $file_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_ext)) {
            array_push($errors, "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
        }

        if ($image_size > 2000000) { // ตรวจสอบขนาดไฟล์ (2MB)
            array_push($errors, "Image size exceeds limit (2MB).");
        }

        // ตั้งชื่อไฟล์ใหม่เพื่อป้องกันการชนกัน
        $upload_dir = 'img/'; // โฟลเดอร์สำหรับเก็บไฟล์รูปภาพ

        if (count($errors) == 0) {
            // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ที่กำหนด
            if (move_uploaded_file($image_tmp_name, $upload_dir . $image_name)) {
                // อัปเดตรายการผลิตภัณฑ์พร้อมชื่อไฟล์รูปภาพใหม่
                $sql = "UPDATE products SET 
                        product_name = '".$_POST["ProductName"]."',
                        category = '".$_POST["category"]."', 
                        price = '".$_POST["priceProducts"]."', 
                        stock_quantity = '".$_POST["QuantityProduct"]."',
                        product_img = '$image_name'
                        WHERE product_id = '$ProductID'";
                        
                $query = mysqli_query($conn, $sql);

                if ($query) {
                    echo "Record updated successfully"; 
                    header('location: adminpage1.php');
                    exit();
                } else {
                    array_push($errors, "Failed to update product. Please try again.");
                }
            } else {
                array_push($errors, "Failed to upload image. Please try again.");
            }
        }
    } else {
        // กรณีไม่มีการอัปโหลดรูปภาพใหม่ (ใช้รูปเดิม)
        if (count($errors) == 0) {
            $sql = "UPDATE products SET 

                    product_name = '".$_POST["ProductName"]."',
                    category = '".$_POST["category"]."', 
                    price = '".$_POST["priceProducts"]."', 
                    stock_quantity = '".$_POST["QuantityProduct"]."'
                    WHERE product_id = '$ProductID'";
            
            $query = mysqli_query($conn, $sql);

            if ($query) {
                echo "Record updated successfully";
                header('location: adminpage1.php');
                exit();
            } else {
                array_push($errors, "Failed to update product. Please try again.");
            }
        }
    }

    // แสดงข้อผิดพลาดหากมี
    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        header('location: login.php');
    }
}
?>
