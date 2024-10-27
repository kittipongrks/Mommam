<?php
session_start();

if (isset($_POST['index']) && isset($_SESSION['cart'])) {
    $index = $_POST['index'];


    if (array_key_exists($index, $_SESSION['cart'])) {
        
        unset($_SESSION['cart'][$index]);
        
        
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}


header("Location: cart.php");
exit();
?>
