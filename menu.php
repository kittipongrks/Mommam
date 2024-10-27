<?php
include 'server.php';
session_start();
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <title>Products</title>
</head>

<body>
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
                    <li class="nav-item">
                        <a class="nav-link nav-link-1 " aria-current="page" href="index.php">Ceramic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-5" href="canvas.php">Canvas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-6 " href="Digital.php">Digital</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-2" href="videos.php">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-3" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-3 active" href="menu.php">Shop</a>
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
    <?php
    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT product_id, product_name, price,img_url FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='product-container'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-card'>";
            echo "<img src='data:image/png;base64," . base64_encode($row['img_url']) . "' alt='" . htmlspecialchars($row['product_name']) . "'>";
            echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['price']) . "</p>";
            echo "<form method='post' action='process_selection.php'>";
            echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
            echo "<input type='hidden' name='product_name' value='" . htmlspecialchars($row['product_name']) . "'>";
            echo "<input type='hidden' name='price' value='" . htmlspecialchars($row['price']) . "'>";
            echo "<button type='submit' class='btn btn-primary'>Add</button>";
            echo "</form>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "ไม่มีสินค้าในระบบ";
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


</body>

</html>