<?php
session_start();
include 'server.php';
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$_SESSION['PAGE'] = 'detail.php';



// เปิดการแสดงข้อผิดพลาด
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ตรวจสอบว่ามีการส่ง product_id มาหรือไม่
if (isset($_GET["product_id"])) {
    $product_id = mysqli_real_escape_string($conn, $_GET["product_id"]); // ป้องกัน SQL Injection

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $query = mysqli_query($conn, $sql);

    // ตรวจสอบว่าพบข้อมูลหรือไม่
    if ($query && mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    } else {
        echo "ไม่พบข้อมูลสินค้า";
        exit();
    }
} else {
    echo "ไม่พบรหัสสินค้า";
    exit();
}

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MomMam deta page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/index.css">

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
                    if (!empty($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link nav-link-3' href='profile.php'>Profile</a></li>";
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-1" href="index.php">Ceramic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-5" href="canvas.php">Canvas</a>
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
                            echo "<a class='nav-link nav-link-3' href='logout.php'>Logout</a>";
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

    <div class="tm-kunjae d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/ปั้นยังไม่เผาเล็ก1.jpg">
        <a class="txt-wellcome">ขอบคุณสำหรับการเยี่ยมชมเว็บไซต์</a>
    </div>

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">รายละเอียดผลงาน</h2>
        </div>
        <div class="row tm-mb-90">
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                <div class="maincanvas">
                    <img src="<?php echo isset($result['product_img']) ? 'img/' . $result['product_img'] : 'img/default.jpg'; ?>" alt="Image" class="img-fluid01">
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">
                    <p class="mb-4">
                    <p>ชื่อผลงาน: <?php echo isset($result['product_name']) ? $result['product_name'] : 'ไม่มีชื่อสินค้า'; ?></p>
                    <p>ราคา: <?php echo isset($result['price']) ? $result['price'] : 'ไม่ระบุ'; ?> บาท</p>
                    <p>รายละเอียด: <?php echo isset($result['category']) ? $result['category'] : 'ไม่มีข้อมูล'; ?></p>
                    <p>ศิลปิน: <?php echo isset($result['artist']) ? $result['artist'] : 'ไม่ระบุ'; ?></p>

                    <!-- ปุ่ม Add -->
                    <?php
                    if(!empty($_SESSION['username'])){
                        if($result['stock_quantity']>0){
                            echo '<button type="button" class="btn btn-bottos" onclick="addToCart(' . $result['product_id'] . ', \'' . htmlspecialchars($result['product_name']) . '\', ' . htmlspecialchars($result['price']) . ')">Add</button>';
                        }else{
                            echo '<button type="button" class="btn btn-bottos" disabled onclick="addToCart(' . $result['product_id'] . ', \'' . htmlspecialchars($result['product_name']) . '\', ' . htmlspecialchars($result['price']) . ')">Add</button>';
                        echo "<div class='alert alert-danger alert-dismissible fade show'>
                                <strong>Out of Stock!</strong> สินค้าหมดอดนะจ๊ะ.
                                </div>";
                        }
                    }else{
                        echo '<button type="button" class="btn btn-bottos" disabled onclick="addToCart(' . $result['product_id'] . ', \'' . htmlspecialchars($result['product_name']) . '\', ' . htmlspecialchars($result['price']) . ')">Add</button>';
                        echo "<div class='alert alert-danger alert-dismissible fade show'>
                                <strong>Login!</strong> ก่อนกดนะจ๊ะะ.
                            </div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });

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
                <p>เป็นเว็บไซต์ที่สร้างขึ้นเพื่อ รวบรวมผลงานศิลปะของเพื่อนรัก "ปอวชิ" ที่อยากจะอวดให้ทุกคนได้เห็นและสนับสนุนผลงานศิลปะที่สวยงามและน่ารัก >3</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                <h3 class="tm-text-primary mb-4 tm-footer-title">Our Links</h3>
                <ul class="tm-footer-links pl-0">
                    <li><a href="index.php">Ceramic</a></li>
                    <li><a href="canvas.php">Canvas</a></li>
                    <li><a href="Digital.php">Digital</a></li>
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

</html>