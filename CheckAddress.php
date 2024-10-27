<?php 
    session_start();
    include 'server.php';
    $UserID = $_SESSION['UserID'];
    $sql = "SELECT address FROM customers WHERE UserID = '$UserID'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // ตรวจสอบว่า address ถูกกรอกหรือไม่
        if (!empty($row['address'])) {
            // ถ้ามีที่อยู่ให้เปลี่ยนเส้นทางไปยังหน้า checkQuantity
            $_SESSION['address'] = $row['address'];
            header("Location: CheckQuantity.php");
            exit(); // สิ้นสุดการทำงานของสคริปต์
        } else {
            // ถ้าไม่มีที่อยู่ให้แจ้งเตือนและแสดงฟอร์มให้กรอกที่อยู่
            $_SESSION['error'] = "!!! Wrong Username or Password!";
            echo "<script>alert('กรุณากรอกที่อยู่ก่อนดำเนินการต่อ');</script>";
            echo "<script> window.location.href='edit_profile.php'; </script>";
        }
    } else {
        echo "ไม่พบผู้ใช้ในระบบ";
    }

    $stmt->close();
    $conn->close();


?>
