<?php 
session_start();
include ('server.php');

$errors = array();

if (isset($_POST['Edit_customers'])) {
    // รับค่าจากฟอร์ม
    $username = $_POST["username"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $lname =$_POST["lname"];
    $email =$_POST["email"];

    
    // ตรวจสอบว่าผลิตภัณฑ์มีอยู่แล้วหรือไม่
    $user_check_query = "SELECT * FROM customers WHERE username = '$username'";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);

        if (count($errors) == 0) {
                $sql = "UPDATE customers SET 
                    username = '".$_POST["username"]."',
                    fname = '".$_POST["fname"]."',
                    lname = '".$_POST["lname"]."',
                    phone = '".$_POST["phone"]."',
                    address = '".$_POST["address"]."',
                    email = '".$_POST["email"]."'
                    WHERE username = '$username'";
                $query = mysqli_query($conn, $sql);
                header('location: profile.php');
        }
    } 


    // แสดงข้อผิดพลาดหากมี
    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        echo "<script> alert('เกิดข้อผิดพลาด!'); </script>";
        echo "<script> window.location.href='profile.php?updated=true'; </script>";
    }

?>
