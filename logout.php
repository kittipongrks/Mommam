<?php
session_start();
session_unset(); // ล้างข้อมูลเซสชัน
session_destroy(); // ทำลายเซสชัน
header("Location: index.php");  // เปลี่ยนเส้นทางกลับไปที่หน้า login
exit();
?>