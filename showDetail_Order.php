<?php
session_start();
include 'server.php';

// ตรวจสอบว่ามีการส่งค่า order_id มาหรือไม่
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    echo "ไม่พบ Order ID.";
    exit();
}

$order_id = $_GET["order_id"];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="images/main_pic.jfif"/>
    <script src="https://kit.fontawesome.com/5368a84f0e.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8c3d7; /* Soft yellow background */
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #343a40;
            font-weight: bold;
        }
        .container {
            margin-top: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #f8c3d7; /* Pink header */
            color: #343a40;
            text-align: center;
            font-weight: bold;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-primary {
            background-color: #f497b6; /* Pink for primary action button */
            border: none;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #f8c3d7;
        }
        .total-price {
            font-weight: bold;
            color: #e67e22; /* Orange color for total price */
            font-size: 1.2rem;
        }
        .link-back {
            color: #f497b6;
            font-weight: bold;
            text-decoration: none;
        }
        .link-back:hover {
            color: #f8c3d7;
        }
    </style>
    <title>ตะกร้าสินค้า</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">ID ของ Order : <?php echo htmlspecialchars($order_id); ?></h2>
        <table class="table table-bordered mt-4">
                <tr>
                    <th>รูปสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>ราคารวมทั้งหมด</th>
                </tr>
            <?php 
            $order_check_query = "SELECT order_items.order_id, orders.order_date, order_items.total_price, orders.address ,order_items.product_id ,products.product_name , order_items.quantity ,order_items.unit_price , products.product_img
                                    FROM order_items INNER JOIN orders ON order_items.order_id = orders.order_id INNER JOIN products ON order_items.product_id = products.product_id WHERE order_items.order_id = '$order_id'" ;
            $query = mysqli_query($conn, $order_check_query);
            $result = $conn->query($order_check_query);
            if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>
                         <td width='30'><img src='img/" . $row['product_img'] . "' width='100px'></td>
                        <td>".$row['product_name']."</td>
                        <td>".$row['quantity']."</td>
                        <td>".$row['unit_price']."</td>
                        <td>".$row['total_price']."</td>
                    <tr>";
                }
            }else{
                echo "0 result";
            }
            ?>
        </table>
    </div>
</body>
</html>

