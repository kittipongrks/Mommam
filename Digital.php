<?php
session_start();
include 'server.php';
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$_SESSION['PAGE'] = 'Digital.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MomMam Digital page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/all.min.css">
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
            <a class="navbar-brand" href="index.php">
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
                                echo "<a class='nav-link nav-link-3' href='profile.php'>Profile</a>";
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
                                <a class="nav-link nav-link-6 active" aria-current="page" href="Digital.php">Digital</a>
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

            <div class="container-fluid tm-container-content tm-mt-60">
                <div class="row mb-4">
                    <h2 class="col-6 tm-text-primary">
                        ผลงานทั้งหมด
                    </h2>
                </div> <!-- row -->
            </div> <!-- container-fluid, tm-container-content -->



            <?php
            // ดึงข้อมูลสินค้าจากฐานข้อมูล
            $sql = "SELECT *FROM products WHERE category = 'Digital'  ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='product-container'>";

                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-card'>";
                    echo "<a href='detail.php?product_id=" . $row['product_id'] . "'><img src='img/" . htmlspecialchars($row['product_img']) . "' alt='" . htmlspecialchars($row['product_name']) . "'></a>";
                    echo "<h3> ชื่อผลงาน: " . htmlspecialchars($row['product_name']) . "</h3>";
                    echo "<h3> ราคา: " . htmlspecialchars($row['price']) . " บาท</h3>";
                    echo "<h4> ศิลปิน: " . htmlspecialchars($row['artist']) . "</h3>";
                    echo "<form method='post' action='process_selection.php'>";
                    echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
                    echo "<input type='hidden' name='product_name' value='" . htmlspecialchars($row['product_name']) . "'>";
                    if(!empty($_SESSION['username'])){
                        if($row['stock_quantity']>0){
                            echo "<button type='submit' class='btn btn-bottos'>Add</button>";
                            echo "<input type='hidden' name='price' value='" . htmlspecialchars($row['price']) . "'>";
                        }else{
                            echo "<button type='button' class='btn btn-bottos' disabled>Add</button>";
                        echo "<div class='alert alert-danger alert-dismissible fade show'>
                                <strong>Out of Stock!</strong> สินค้าหมดอดนะจ๊ะ.
                            </div>";
                        }
                    }else{
                        echo "<button type='button' class='btn btn-bottos' disabled>Add</button>";
                        echo "<div class='alert alert-danger alert-dismissible fade show'>
                                <strong>Login!</strong> ก่อนกดนะจ๊ะะ.
                            </div>";
                    }
                    echo "</form>";
                    echo "</div>";
                }
                echo "</div>";
            }
            $conn->close();
            ?>
            <script>
                function addToCart(productId, productName, price) {
                    fetch('process_selection.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `product_id=${productId}&product_name=${encodeURIComponent(productName)}&price=${price}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const cartCountElement = document.getElementById('cart-count');
                                cartCountElement.innerText = data.cart_count; // อัปเดตจำนวนสินค้าในตะกร้า
                            } else {
                                console.error('Error:', data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
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
                <li class="mb-2"><a href="https://www.instagram.com/beombaedy.studio?igsh=cWF3YW5vZmR6MmNk">ช่องทางการติดตาม : <i class="fab fa-instagram"></i></a></li>
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