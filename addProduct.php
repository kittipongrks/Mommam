<?php 
    session_start();
    include('server.php'); // ไฟล์เชื่อมต่อกับฐานข้อมูล

    $errors = array();

    if (isset($_POST['add_products'])) {
        // ตั้งค่าโฟลเดอร์ที่เก็บไฟล์รูปภาพ
        $targetDir = "img/";

        // รับข้อมูลจากฟอร์ม
        $ProductName = mysqli_real_escape_string($conn, $_POST['ProductName']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $priceProducts = mysqli_real_escape_string($conn, $_POST['priceProducts']);
        $QuantityProduct = mysqli_real_escape_string($conn, $_POST['QuantityProduct']);

        // จัดการไฟล์รูปภาพ
        $imageProduct = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $imageProduct;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // ประเภทไฟล์ที่อนุญาต
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif');


        // ตรวจสอบไฟล์ซ้ำในฐานข้อมูล
        $product_check_query = "SELECT * FROM products WHERE product_name = '$ProductName' OR product_img = '$imageProduct' LIMIT 1";
        $query = mysqli_query($conn, $product_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            if ($result['product_img'] === $imageProduct && $result['product_name'] === $ProductName) {
                array_push($errors, "Product and Image already exist!");
            }
            if ($result['product_name'] === $ProductName) {
                array_push($errors, "Product already exists!");
            }
            if ($result['product_img'] === $imageProduct) {
                array_push($errors, "Image already exists!");
            }
        }

        // ถ้าไม่มีข้อผิดพลาด ให้บันทึกข้อมูล
        if (count($errors) == 0) {
            // ตรวจสอบประเภทไฟล์ก่อนอัปโหลด
            if (in_array($fileType, $allowTypes)) {
                // ย้ายไฟล์ไปยังโฟลเดอร์
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $sql = "INSERT INTO products (product_name, category, price, stock_quantity, product_img , artist) 
                            VALUES ('$ProductName', '$category', '$priceProducts', '$QuantityProduct', '$imageProduct' , 'beombaedy')";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['success'] = "Product added successfully";
                        header('location: adminpage1.php');
                    } else {
                        array_push($errors, "Failed to add product. Please try again.");
                        echo "<script>alert('Only JPG, JPEG, PNG, GIF, & JFIF files are allowed.');</script>";
                    }
                } else {
                    array_push($errors, "Failed to upload image. Please try again.");
                    echo "<script>alert('Failed to upload image. Please try again.');</script>";
                }
            } else {
                array_push($errors, "Only JPG, JPEG, PNG, GIF, & JFIF files are allowed.");
                echo "<script>alert('Only JPG, JPEG, PNG, GIF, & JFIF files are allowed.');</script>";
            }
        }

        // เก็บข้อผิดพลาดใน session เพื่อแสดงผลในหน้าอื่น ๆ (ถ้ามี)
        if (!empty($errors)) {
            $_SESSION['error'] = implode('<br>', $errors);
            header('location: login.php');
        }
    }
?>
