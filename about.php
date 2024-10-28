<?php
session_start();
include 'server.php';
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$_SESSION['PAGE'] = 'canvas.php'

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MomMam Canvas page</title>
    <link rel="icon" type="image/png" href="images/main_pic.jfif"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/team.css">

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
                        <a class="nav-link nav-link-6 " href="Digital.php">Digital</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-3 active" aria-current="page" href="about.php">About</a>
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
    <div class="product-container">
        <div class="row d-flex justify-content-evenly ">
            <div class="product-card">
                <img src="img/imadooka.jpg" alt="Painting 1" class="img-fluid">
                <p>นางสาวพิยดา บูระอาจ</p>
                <p>รหัสนิสิต 65313488</p>
                <a href="https://www.facebook.com/Piyadamook.da" class="tm-text-gray"  target="_parent">facebook</a>
            </div>
            <div class="product-card">
                <img src="img/pluem.jpg" alt="Painting 2" class="img-fluid">
                <p>นายสิรภพ เล็กเลิศสุนทร</p>
                <p>รหัสนิสิต 65315147</p>
                <a href="https://www.facebook.com/sirapob.lackloadsonton" class="tm-text-gray"  target="_parent">facebook</a>
            </div>
            <div class="product-card">
                <img src="img/Nak.png" alt="Painting 3" class="img-fluid">
                <p>นายกิตติพงศ์ ฤกษ์เกษี</p>
                <p>รหัสนิสิต 65310340</p>
                <a href="https://www.facebook.com/profile.php?id=100006417406729" class="tm-text-gray"  target="_parent">facebook</a>
            </div>
            <div class="product-card">
                <img src="img/milk.jpg" alt="Painting 4" class="img-fluid">
                <p>นางสาวมนัสนันท์ คงมณี</p>
                <p>รหัสนิสิต 65314065</p>
                <a href="https://www.facebook.com/profile.php?id=100063896433295" class="tm-text-gray"  target="_parent">facebook</a>
            </div>
            <div class="product-card">
                <img src="img/kuydew.jpg" alt="Painting 5" class="img-fluid">
                <p>นายบุญญฤทธิ์ ยาวิใจ</p>
                <p>รหัสนิสิต 65312641</p>
            </div>
        </div>
    </div>


    <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">About MomMam</h3>
                    <li class="mb-2"><a href="https://www.instagram.com/beombaedy.studio?igsh=cWF3YW5vZmR6MmNk"><i class="fab fa-instagram"></i></a></li>
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
                        <li class="mb-2"><a href="https://www.instagram.com/beombaedy.studio?igsh=cWF3YW5vZmR6MmNk">ช่องการการติดตาม<i class="fab fa-instagram"></i></a></li>
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