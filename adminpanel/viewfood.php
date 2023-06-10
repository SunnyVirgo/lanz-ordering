<?php include 'managefood.php'; ?>

          <?php if (isset($_GET['id'])) {
              $id = $_GET['id'];

              $sql2 = "SELECT m.*, c.category_name as `category_name` from `tbl_food` m inner join food_category c on m.category_id = c.id where m.id = '{$_GET['id']}'";

              $res2 = mysqli_query($conn, $sql2);

              $row2 = mysqli_fetch_assoc($res2);

              $food_name = $row2['food_name'];

              $description = $row2['description'];
              $size = $row2['size'];
              $stocks = $row2['stocks'];
              $price = $row2['price'];
              $current_image = $row2['image_name'];
              $category = $row2['category_name'];
              $date = $row2['date_created'];
              $featured = $row2['featured'];
              $status = $row2['status'];
              $vat = $row2['withvat'];
          } ?>

<div class="login01" id="MyModal" tabindex="-1" role="dialog">
        <div class="login-content2">
            <div class="head"> <h2>Food Details</h2></div>
                <div class="food-details">
                    <?php if ($current_image != '') { ?>
                                    <img src = "../images/foods/<?php echo $current_image; ?>" width ="500px" height="200px">
                                    <?php } else {echo 'Image not added';} ?></span>
                            <p>Category</p><span><?php echo $category; ?> </span>
                    <p>Name</p><span><?php echo $food_name; ?></span>
                    <p>Size</p><span><?php echo $size; ?></span>
                    <p>Description</p><span><?php echo $description; ?></span>
                    <p>Servings Available</p><span><?php echo $stocks; ?></span>
                    <p>Price</p><span><?php echo $price; ?></span>
                      <p>Date Created</p><span><?php echo $date; ?></span>
                    
                    <p>Featured</p><span><?php echo $featured; ?></span>
                    <p>Vat</p><span><?php if($vat == 1){
echo 'With VAT'; 
                    }
                    else
                    {
                        echo 'Without VAT';   
                    } ?></span>
                    <p>Status</p><span><?php if ($stocks > 0) { ?>
                                        <div class="status1">Available</div>
                                        <?php } else { ?>
                                        <div class="status-not1">Not Available</div>
                                        <?php } ?></span>
                </div>
             <div class="close-btn">  <a href="managefood.php">  <button class="btn-close" data-dismiss ="modal" aria-hidden="true">Close</button></a></div>
        </div>
            
    </div>   