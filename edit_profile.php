
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขโปรไฟล์ของคุณ</title>
    <link rel="icon" type="image/png" href="images/main_pic.jfif"/>
    <link rel="stylesheet" href="css/editprofile.css">

</head>
<body>
<?php
    session_start();
    include('server.php'); 

// Check if the form is submitted


?>
<div class="container">
    <h2>แก้ไขโปรไฟล์ของคุณ</h2>
    <form method="POST" action="EditProfileSave.php">
        <input type="hidden" id="username" name="username" value="<?= $_SESSION['username']; ?>">

        <label for="address">ชื่อ</label>
        <input type="text" id="fname" name="fname" value="<?= $_SESSION['fname']; ?>" required>

        <label for="address">นามสกุล</label>
        <input type="text" id="lname" name="lname" value="<?= $_SESSION['lname']; ?>" required>

        <label for="address">ที่อยู่:</label>
        <input type="text" id="address" name="address" value="<?= $_SESSION['address']; ?>">

        <label for="phone">เบอร์โทร:</label>
        <input type="text" id="phone" name="phone" pattern="[0-9]{10}" maxlength="10" minlength = "10" value="<?= $_SESSION['phone']; ?>">

        <label for="email">อีเมล:</label>
        <input type="email" id="email" name="email" value="<?= $_SESSION['email']; ?>" required>

        <button type="submit" name = "Edit_customers">บันทึกการเปลี่ยนแปลง</button>
        <button type="button" class="cancel-button" onclick="window.location.href='profile.php'">ยกเลิก</button>
    </form>
</div>

</body>
</html>
