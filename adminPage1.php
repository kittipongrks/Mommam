<?php include 'server.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin | dashboard</title>
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link href="css/sidebar.css" rel="stylesheet">
   <link href="css/theme.css" rel="stylesheet" media="all">
   <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="https://kit.fontawesome.com/5368a84f0e.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="images/main_pic.jfif"/>

    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
</head>
<body>
<?php 
    session_start();
    $sql = "SELECT * FROM customers WHERE User_status = 'USER'" ;
      $result = mysqli_query($conn , $sql);


      $sql_product = "SELECT * FROM products";
      $result_product = mysqli_query($conn , $sql_product);

      
      $sql_totalPrice = "SELECT SUM(total_amount) AS total_sum FROM orders";
      $result_totalPrice = mysqli_query($conn , $sql_totalPrice);


      $sql_orders = "SELECT * FROM orders ORDER BY order_id DESC"  ;
      $result_orders = mysqli_query($conn , $sql_orders);

    if ($_SESSION['role'] === 'ADMIN'){

    }else{
        $_SESSION['error'] = "this page can only use by admin";
        header('location: login.php');
    }
?>

<!-- class="toggle-btn" สำหรับเปิดปิด sidebar-->
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="#" class="js-arrow">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="#AllUser">
                                <i class="fas fa-chart-bar"></i>ข้อมูลผู้ใช้งาน</a>
                        </li>
                        <li>
                            <a href="#Products_all">
                                <i class="fas fa-table"></i>ข้อมูลสินค้า</a>
                        </li>
                        <li>
                            <a href="#Orders_group">
                            <i class="fa-solid fa-cart-shopping"></i>ข้อมูลการสั่งซื้อ</a>
                        </li>
                                               
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                <img src="images/main_pic.jfif" width = "30%"/>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="#AllUser">
                                <i class="fas fa-chart-bar"></i>ข้อมูลผู้ใช้งาน</a>
                        </li>
                        <li>
                            <a href="#Products_all">
                                <i class="fas fa-table"></i>ข้อมูลสินค้า</a>
                        </li>
                        <li>
                            <a href="#Orders_group">
                            <i class="fa-solid fa-cart-shopping"></i>ข้อมูลการสั่งซื้อ</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
                                <div class="noti-wrap">

                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/main_pic.jfif" />
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/main_pic.jfif"/>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a><?php echo $_SESSION['username']?></a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
    
    <div class="main-content">
      <div class="main bg-white p-3">
        <!-- ใส่เนื้อหา main ที่นี่ -->
            <div class="container">
            <div class="row mt-4">
                    <div class="col-lg-12 d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="text-primary">Overall</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row m-t-25">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="overview-item overview-item--c1">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-account-o"></i>
                                                    </div>
                                                    <div class="text">
                                                        <h2><i class="fa-solid fa-user"></i>
                                                        <?php
                                                        $sql = "SELECT * FROM customers WHERE User_status = 'USER'" ;
                                                        $result = mysqli_query($conn , $sql);
                                                        echo mysqli_num_rows($result);
                                                        ?> 
                                                        </h2>
                                                        <span>members </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="overview-item overview-item--c2">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-shopping-cart"></i>
                                                    </div>
                                                    <div class="text">
                                                        <h2><i class="fa-solid fa-image"></i>
                                                        <?php 
                                                        $sql_product = "SELECT * FROM products";
                                                        $result_product = mysqli_query($conn , $sql_product);
                                                        echo mysqli_num_rows($result_product); ?></h2>
                                                        <span>Products</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="overview-item overview-item--c3">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-calendar-note"></i>
                                                    </div>
                                                    <div class="text">
                                                    <h2><i class="fa-solid fa-box"></i>
                                                        <?php echo mysqli_num_rows($result_orders); ?></h2>
                                                    <span>Order</span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="overview-item overview-item--c4">
                                            <div class="overview__inner">
                                                <div class="overview-box clearfix">
                                                    <div class="icon">
                                                        <i class="zmdi zmdi-money"></i>
                                                    </div>
                                                    <div class="text">
                                                        <h2><i class="fa-solid fa-coins"> </i> <?php  
                                                            $sql_totalPrice = "SELECT SUM(total_amount) AS total_amount FROM orders"; // เปลี่ยน column_name และ table_name ให้ตรงกับของคุณ
                                                            $result_totalPrice = $conn->query($sql_totalPrice);

                                                            // ตรวจสอบผลลัพธ์
                                                            if (!$result_totalPrice) {
                                                                die("คำสั่ง SQL ผิดพลาด: " . $conn_totalPrice->error);
                                                            }

                                                            if ($result_totalPrice->num_rows > 0) {
                                                                // ดึงข้อมูล
                                                                $row_totalPrice = $result_totalPrice->fetch_assoc();
                                                                echo "" . number_format($row_totalPrice['total_amount'],2) . " ฿";
                                                            } else {
                                                                echo "ไม่พบข้อมูล";
                                                            }?>
                                                        </h2>
                                                        <span>total earnings </span>
                                                    </div>
                                                </div>
                                                <div class="overview-chart">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
                <!-- this is a customers group-->
                <div class="row mt-4" id = "AllUser">
                    <div class="col-lg-12 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="text-primary">Users in database</h4>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="showAlert"> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-boredered text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if (mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo "<tr>
                                                <td>".$row['UserID']."</td>
                                                <td>".$row['username']."</td>
                                                <td>".$row['email']."</td>
                                                <td>".$row['phone']."</td>
                                                <td>".$row['address']."</td>
                                            <tr>";
                                        }
                                    }else{
                                        echo "0 result";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Add New product Modal Start -->
            <div class="modal fade" tabindex="-1" id="addNewProductModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-header">Add New Products</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"> 
                            <!--form สำหรับเพิ่มข้อมูลสินค้า -->
                            <form id="add-products-form" class="p-2" action="addProduct.php" method="post" enctype="multipart/form-data">
                                <div class="row mb-3 gx-3">
                                    <div class="col">
                                        <input type="text" name="ProductName" class="form-control" placeholder="Products Name" required>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Select Category</label>
                                </div>
                                <select class="custom-select" id="inputGroupSelect01" name = "category">
                                    <option ></option>
                                    <option value="Ceramic">Ceramic</option>
                                    <option value="Digital">Digital Art</option>
                                    <option value="Canvas">Canvas</option>
                                </select>
                                </div>
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" name = "priceProducts"aria-label="Amount (to the nearest dollar)" placeholder = "Enter Products Price" Required>
                                <div class="invalid-feedback">Product Price is required!</div>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">฿</span>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" name="QuantityProduct" class="form-control" placeholder="Enter Stock Quantity" required>
                                    <div class="invalid-feedback">Stock Quantity is required!</div>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">เพิ่มรูปภาพของ Product</label>
                                    <input class="form-control" type="file" id="formFile" name = "image">
                                </div>
                                <?php include('errors.php'); ?>
                                <?php if (isset($_SESSION['error'])) : ?>
                                    <div class="error">
                                        <h6 class = "requiredment">
                                            <?php 
                                                echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                            ?>
                                        </h6>
                                    </div>
                                <?php endif ?>
                                <div class="mb-3">
                                    <input type="submit" value="Add Products" class="btn btn-primary btn-block btn-lg" id="add-Products-btn" name = "add_products">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add New Products Modal End -->
            <!-- this is a Products group-->
                <div class="row mt-4" id = "Products_all">
                    <div class="col-lg-12 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="text-primary" id = "">Products in database</h4>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNewProductModal">Add New Product</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="showAlert"> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-boredered text-center">
                                <thead>
                                    <tr>
                                        <th>ภาพสินค้า</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if (mysqli_num_rows($result_product) > 0){
                                        while($row = mysqli_fetch_assoc($result_product)){
                                                echo "<tr>
                                                    <td width='30'><img src='img/" . $row['product_img'] . "' width='100px'></td>
                                                    <td>" . $row['product_id'] . "</td>
                                                    <td>" . $row['product_name'] . "</td>
                                                    <td>" . $row['category'] . "</td>
                                                    <td>" . $row['price'] . "</td>
                                                    <td>" . $row['stock_quantity'] . "</td>
                                                    <td>
                                                        <a href = edit_product.php?product_id=".$row['product_id']."><button class='btn btn-warning' type='button' data-bs-toggle='modal'> 
                                                            <i class='fa-solid fa-wrench'></i>
                                                        </button></a>
                                                    </td>
                                                    <td>
                                                        <a href = delete_product.php?product_id=".$row['product_id']."><button class='btn btn-danger' type='button' data-bs-toggle='modal'>
                                                            <i class='fa-solid fa-trash-can'></i>
                                                        </button></a>
                                                    </td>
                                                </tr>";
                                        }
                                    }else{
                                        echo "0 result";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- this is a customers group-->
                <div class="row mt-4" id = "Orders_group">
                    <div class="col-lg-12 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="text-primary">Orders in database</h4>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-boredered text-center">
                                <thead>
                                    <tr>
                                        <th>OrderID</th>
                                        <th>UserID</th>
                                        <th>วันที่สั่ง</th>
                                        <th>สถานะ</th>
                                        <th>ยอดชำระ</th>
                                        <th>ที่อยู่จัดส่ง</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if (mysqli_num_rows($result_orders) > 0){
                                        while($row = mysqli_fetch_assoc($result_orders)){
                                            echo "<tr><td>".$row['order_id']."</td>
                                            <td>".$row['UserID']."</td>
                                            <td>".$row['order_date']."</td>
                                            <td>".$row['status']."</td>
                                            <td>".$row['total_amount']."</td>
                                            <td>".$row['address']."</td>
                                            <td>
                                                <a href = edit_order.php?order_id=".$row['order_id'].">
                                                <button class='btn btn-warning' type='button' data-bs-toggle='modal'> 
                                                    <i class='fa-solid fa-wrench'></i>
                                                </button></a>
                                                </td>
                                            <tr>";
                                        }
                                    }else{
                                        echo "0 result";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
        </div>
</body>
<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="js/sidebar.js"></script>

</html>