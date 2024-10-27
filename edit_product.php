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
   ini_set('display_errors', 1);
   error_reporting(~0);
   if(isset($_GET["product_id"]))
   {
	   $product_id = $_GET["product_id"];
   }
   include 'server.php';
   $sql = "SELECT * FROM products WHERE product_id = '".$product_id."' ";
   $query = mysqli_query($conn , $sql);
   $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

  ?>
  <!-- Edit product Modal Start -->           
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-header">Edit <?php echo "ID : ".$result['product_id'] . " " . $result['product_name']; ?></h5>
                            <a href = 'adminpage1.php'><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                        </div>
                        <div class="modal-body">
                            <form id="edit-products-form" class="p-2" action="EditProductSave.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" id ="product_id" value = "<?php echo $result["product_id"];?>">

                                <!-- ส่วนของฟอร์มแก้ไขสินค้า -->
                                <div class="mb-3">
                                    <label for="ProductName">Product Name</label>
                                    <input type="text" name="ProductName" class="form-control" value = "<?php echo $result["product_name"];?>"required>
                                </div>

                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select class="form-select" name="category" id="category"required>
                                        <option value="Ceramic" <?php if($result['category'] == 'Ceramic') echo 'selected'; ?>>Ceramic</option>
                                        <option value="Digital" <?php if($result['category'] == 'Digital') echo 'selected'; ?>>Digital Art</option>
                                        <option value="Canvas" <?php if($result['category'] == 'Canvas') echo 'selected'; ?>>Canvas</option>
                                    </select>
                                </div>

                                <!-- ฟิลด์อื่นๆ เช่น ราคา สต็อก รูปภาพ -->
                                <div class="mb-3">
                                    <label for="priceProducts">Price</label>
                                    <input type="text" name="priceProducts" class="form-control" id = "priceProducts" value = "<?php echo $result["price"];?>"required>
                                </div>

                                <div class="mb-3">
                                    <label for="QuantityProduct">Stock Quantity</label>
                                    <input type="number" name="QuantityProduct" class="form-control" id = "QuantityProduct" value = "<?php echo $result["stock_quantity"];?>"required>
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Add new Image Products</label>
                                    <input class = "form-control" type="file" name="product_image"><br>
                                    <div class="row ">
                                      <center><img src="img/<?php echo $result['product_img']; ?>" alt="Current Image" style="width: 150px;">
                                      <center><label for="image">Product Image old </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="submit" value="Edit Products" class="btn btn-primary btn-block" id = "edit-products-btn" name = "Edit_products">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <!-- Edit Products Modal End -->
</body>
</html>