<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="images/main_pic.jfif"/>
  <script src="https://kit.fontawesome.com/5368a84f0e.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php 
  if ($_SESSION['role'] === 'ADMIN'){

  }else{
      array_push($errors, "!!!this page can only use by admin");
      $_SESSION['error'] = "!!!this page can only use by admin";
      header('location: login.php');
  }
   ini_set('display_errors', 1);
   error_reporting(~0);
   if(isset($_GET["order_id"]))
   {
	   $order_id = $_GET["order_id"];
   }
   include 'server.php';
   $sql = "SELECT * FROM orders WHERE order_id = '".$order_id."'";
   $query = mysqli_query($conn , $sql);
   $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

  ?>
  <!-- Edit product Modal Start -->           
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-header">Edit <?php echo "ID : ".$result['order_id'] . " UserID : " . $result['UserID']; ?></h5>
                            <a href = 'adminpage1.php'><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                        </div>
                        <div class="modal-body">
                            <form id="edit-order-form" class="p-2" action="EditOrderSave.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="order_id" id ="order_id" value = "<?php echo $result["order_id"];?>">

                                <!-- ส่วนของฟอร์มแก้ไขสินค้า -->
                                <div class="mb-3">
                                    <label for="UserID">UserID</label>
                                    <input type="text" name="UserID" class="form-control" value = "<?php echo $result["UserID"];?> " disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="status">Update status</label>
                                    <select class="form-select" name="status" id="status"required>
                                        <option value="onprocess" <?php if($result['status'] == 'onprocess') echo 'selected'; ?>>On Process</option>
                                        <option value="waiting" <?php if($result['status'] == 'waiting') echo 'selected'; ?>>Waiting</option>
                                        <option value="success" <?php if($result['status'] == 'success') echo 'selected'; ?>>Success</option>
                                        <option value="failed" <?php if($result['status'] == 'failed') echo 'selected'; ?>>Failed</option>
                                    </select>
                                </div>

                                <!-- ฟิลด์อื่นๆ เช่น ราคา สต็อก รูปภาพ -->
                                <div class="mb-3">
                                    <label for="order_date">order_date</label>
                                    <input type="text" name="order_date" class="form-control" id = "order_date" value = "<?php echo $result["order_date"];?>"disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="total_amount">total_amount</label>
                                    <input type="number" name="total_amount" class="form-control" id = "total_amount" value = "<?php echo $result["total_amount"];?>"disabled>
                                </div>


                                <div class="mb-3">
                                    <input type="submit" value="Update status" class="btn btn-primary btn-block" id = "edit-order-btn" name = "Edit_Order">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <!-- Edit Products Modal End -->
</body>
</html>