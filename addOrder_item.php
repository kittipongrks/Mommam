<?php 
    session_start();
    include('server.php');
    
    $errors = array();

    if (isset($_POST['confirm_order'])) {
        $order_item_id = mysqli_real_escape_string($conn, $_POST['order_item_id']);
        $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $unit_price = mysqli_real_escape_string($conn, $_POST['unit_price']);
        $total_price = $quantity * $unit_price ;

        $order_check_query = "SELECT * FROM order_items WHERE order_item_id = '$order_item_id' LIMIT 1";
        $query = mysqli_query($conn, $order_check_query);
        $result = mysqli_fetch_assoc($query);


        if (count($errors) == 0) {

            $sql = "INSERT INTO order_items(order_item_id, order_id , product_id , quantity, unit_price , total_price) 
                    VALUES ('$order_item_id', '$order_id','$product_id' ,'$quantity', '$unit_price' , '$total_price')";
            mysqli_query($conn, $sql);

            header('location: order_status.php');
        } else {
            header("location: order_status.php");
        }
    }

?>
