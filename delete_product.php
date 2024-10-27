
<?php
	include 'server.php';

	$product_id = $_GET["product_id"];

	$sql = "DELETE FROM products  WHERE product_id = '".$product_id."' ";

	$query = mysqli_query($conn,$sql);

	header('location: adminPage1.php');
?>
