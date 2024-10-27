<?php
session_start();
include 'server.php';

// ตรวจสอบว่า $_SESSION['cart'] มีอยู่หรือไม่
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// คำนวณราคารวม
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $item_total = $item['price'] * $item['quantity'];
    $total_price += $item_total;
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cart.css">
    <title>ตะกร้าสินค้า</title>
    <link rel="icon" type="image/png" href="images/main_pic.jfif"/>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">ตะกร้าสินค้าของคุณ</h2>
        <?php if (count($_SESSION['cart']) > 0): ?>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>สินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>รวม</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <?php $item_total = $item['price'] * $item['quantity']; ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($item['price']); ?> บาท</td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($item_total); ?> บาท</td>
                            <td>
                                <form action="remove_item.php" method="post" style="display:inline;">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4>ราคารวมทั้งหมด: <?php echo $total_price; ?> บาท</h4>
            <form action="CheckAddress.php" method="post">
                <button type="submit" class="btn btn-success">ยืนยันการสั่งซื้อ</button>
            </form>
        <?php else: ?>
            <p>ไม่มีสินค้าในตะกร้า</p>
        <?php endif; ?>
    </div>

    <p style="text-align: center;" class="comback">
        <a href="index.php">กลับไปที่รายการสินค้า</a>
    </p>
</body>

</html>