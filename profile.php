<?php
session_start();
include('server.php');
$sql = "SELECT* FROM customers";
$result = $conn->query($sql);
include('getSession.php');

// Default user profile data (initial values)

// Retrieve the user profile from session
$username = $_SESSION['username'];

// Display update message if redirected back with a success message
$uatepdMessage = "";
if (isset($_GET['updated']) && $_GET['updated'] == 'true') {
    $updateMessage = "ข้อมูลของคุณได้ถูกอัปเดตเรียบร้อยแล้ว!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MomMam Profile page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/profile2.css">
    <link rel="icon" type="image/png" href="images/main_pic.jfif"/>
    <script src="https://kit.fontawesome.com/5368a84f0e.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="img/dis.jpg" class="logo-image">
                MomMam
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <?php
                    if (empty($_SESSION['username'])) {
                    } else {
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link nav-link-3 active' aria-current='page' href='profile.php'>Profile</a>";
                        echo "</li>";
                    }
                    ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-1 " href="index.php">Ceramic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-5 " href="canvas.php">Canvas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-6 " href="Digital.php">Digital</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-3" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (empty($_SESSION['username'])) {
                            echo "<a class='nav-link nav-link-3' href='login.php'>Login</a>";
                        } else {
                            echo "<a class='nav-link nav-link-3' href='logout.php'>logout</a>";
                        }

                        ?>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php" id="cart" class="cart">
                            <img src="img/cart.png" alt="Shopping Cart" style="width: 50px; height: auto;">
                            <span id="cart-count"><?php echo $cart_count; ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="tm-kunjae d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/ปั้นยังไม่เผาเล็ก1.jpg" href="#">
        <a class="txt-wellcome">ขอบคุณสำหรับการเยี่ยมชมเว็บไซต์</a>
    </div>

    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
    </head>

    <body>

        <div class="container">
            <?php if ($updateMessage): ?>
                <div class="update-message"><?= $updateMessage; ?></div>
            <?php endif; ?>

            <h2>โปรไฟล์ของคุณ</h2>

            <div class="profile-details">
            <?php 
            $user_check_query = "SELECT * FROM customers WHERE username = '$username'";
            $query = mysqli_query($conn, $user_check_query);
            $result = $conn->query($user_check_query);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                echo "<p><strong>ชื่อผู้ใช้:</strong>".$row['username']."<p>";
                echo "<p><strong>ชื่อ:</strong>".$row['fname']."<p>";
                echo "<p><strong>นามสกุล:</strong>".$row['lname']."<p>";
                echo "<p><strong>ที่อยู่:</strong>".$row['address']."<p>";
                echo "<p><strong>เบอร์โทร:</strong>".$row['phone']."<p>";
                echo "<p><strong>อีเมล:</strong>".$row['email']."<p>";
            }  
            ?>
            </div>

            <a href="edit_profile.php" class="edit-button" >แก้ไขข้อมูล</a>

            <h2>ประวัติการซื้อ</h2>
            <table>
                <tr>
                    <th>เลขที่ Order</th>
                    <th>วันที่ซื้อ</th>
                    <th>สถานะ</th>
                    <th>จำนวนเงิน (บาท)</th>
                    <th>ดูรายละเอียด</th>
                </tr>
            <?php 
            $order_check_query = "SELECT orders.order_id, orders.order_date,orders.status, orders.total_amount, orders.address ,customers.username FROM orders INNER JOIN customers ON orders.UserID = customers.UserID WHERE username = '$username'" ;
            $query = mysqli_query($conn, $order_check_query);
            $result = $conn->query($order_check_query);
            if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>
                        <td>".$row['order_id']."</td>
                        <td>".$row['order_date']."</td>
                        <td>".$row['status']."</td>
                        <td>".$row['total_amount']."</td>
                        <td>
                            <a href = showDetail_Order.php?order_id=".$row['order_id']."><button class='btn btn-warning' type='button' data-bs-toggle='modal'> 
                            <i class='fa-solid fa-circle-info'></i>
                            </button></a>
                        </td>
                    <tr>";
                }
            }else{
                echo "0 result";
            }
            ?>
            </table>
        </div>

        <script>
            // ตั้งเวลาให้ข้อความการอัปเดตเลือนหายไปหลังจาก 2 วินาที
            setTimeout(function() {
                var message = document.querySelector('.update-message');
                if (message) {
                    message.style.display = 'none';
                }
            }, 5000);
        </script>
        <script src="js/plugins.js"></script>
        <script>
            $(window).on("load", function() {
                $('body').addClass('loaded');
            });
        </script>
    </body>

    <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">About MomMam</h3>
                    <p>เป็นเว็บไซต์ที่สร้างขึ้นเพื่อ รวบรวมผลงานศิลปะของเพื่อนรัก "ปอวชิ" ที่อยากจะอวดให้ทุกคนได้เห็นและสนับสนุนผลงานศิลปะที่สวยงามและน่ารัก >3
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">Our Links</h3>
                    <ul class="tm-footer-links pl-0">
                        <li><a href="index.php">Ceremic</a></li>
                        <li><a href="canvas.php">Canvas</a></li>
                        <li><a href="videos.php">Digital</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12 px-5 mb-3">
                    love you
                </div>
                <div class="col-lg-4 col-md-5 col-12 px-5 text-right">
                    Designed by <a href="https://templatemo.com" class="tm-text-gray" rel="sponsored" target="_parent">TemplateMo</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>

</html>