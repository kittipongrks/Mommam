<?php
session_start();

// Mock user data (replace with database logic if needed)

$servername = "localhost";
$user = "root";
$password = "12345678";
$dbname = "projectweb";

$conn = new mysqli($servername, $user, $password, $dbname);
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}
$users = [
    ['username' => 'admin', 'password' => '1234'],
    ['username' => 'user', 'password' => 'abcd']
];

// Handle login request
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $validUser = false;
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $validUser = true;
            $_SESSION['username'] = $username;
            break;
        }
    }

    if (!$validUser) {
        $loginError = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Sample products (replace with database query in real case)
$products = [
    ['id' => 1, 'name' => 'Pots and Glasses', 'img' => 'img/เซรามิก กระถาง.jpg'],
    ['id' => 2, 'name' => 'Tray', 'img' => 'img/เซรามิก ถาดเล็ก.jpg'],
    ['id' => 3, 'name' => 'Keychain v.1', 'img' => 'img/เซรามิก พวงกุญแจ3.jpg'],
    ['id' => 4, 'name' => 'Keychain v.2', 'img' => 'img/เซรามิก พวงกุญแจกระต่าย1.jpg']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MomMam Ceramic Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .nav-link, .btn {
            color: #fff;
        }
        .btn:hover {
            color: #fff;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .modal-content {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/dis.jpg" alt="Logo" class="me-2" style="width: 40px; height: 40px;"> MomMam
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <span class="nav-link">ยินดีต้อนรับ, <?= htmlspecialchars($_SESSION['username']); ?></span>
                        </li>
                        <li class="nav-item">
                            <a href="?logout=true" class="btn btn-danger ms-2">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <button class="btn btn-outline-light ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">ผลงานทั้งหมด</h2>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="<?= $product['img']; ?>" class="card-img-top" alt="<?= $product['name']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $product['name']; ?></h5>
                            <form action="cart.php" method="POST" class="mt-3">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                                <button type="submit" class="btn btn-primary w-100">เพิ่มลงตะกร้า</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">User Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="index.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <?php if (isset($loginError)): ?>
                            <p class="text-danger"><?= $loginError; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
