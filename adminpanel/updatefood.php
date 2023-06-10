
                   

<?php include 'managefood.php'; ?>
            
            

          <?php if (isset($_GET['id'])) {
              $id = $_GET['id'];

              $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

              $res2 = mysqli_query($conn, $sql2);

              $row2 = mysqli_fetch_assoc($res2);

              $food_name = $row2['food_name'];
              $description = $row2['description'];
              $size = $row2['size'];
              $stocks = $row2['stocks'];
              $price = $row2['price'];
              $current_image = $row2['image_name'];
              $current_category = $row2['category_id'];
              $featured = $row2['featured'];
              $vat = $row2['withvat'];
          } else {
              echo "<script>window.location.href='managefood.php'</script>";
          } ?>
                                   
    <div class="login1">
    <div class="login-content1">

            
       <form action="" method="POST" enctype="multipart/form-data">
        <div class ="close3">
                <a href="managefood.php"><i class='fa-solid fa-xmark'></i></a>
                </div>
                <table class="table1">
                    <tr>
                        <td>Name:</td>
                   
                        <td><input type="text" name="food_name" value= "<?php echo $food_name; ?>" class="input"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                   
                        <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Size</td>
                   
                        <td><input type="text" name="size" value="<?php echo $size; ?>" class="input"></td>
                    </tr>
                     <tr>
                        <td>Servings</td>
                   
                        <td><input type="number" name="stocks" value="<?php echo $stocks; ?>" class="input"></td>
                    </tr>
                     <tr>
                        <td>Price</td>
                   
                        <td><input type="number" name="price" value="<?php echo $price; ?>" min="1" max="9999" step="any" class="input"></td>
                    </tr>

                    <tr>
                        <td>Current image:</td>
                        <td>
                            <?php if ($current_image == '') {
                                echo "<div class= 'no1'>Image not added</div>";
                            } else {
                                 ?>
                                    <img src = "../images/foods/<?php echo $current_image; ?>" width ="150px" height="100px">
                                    <?php
                            } ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New image:</td>
                        <td><input type="file" name= "image"></td>

                    </tr>
                    
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                                <?php
                                $sql =
                                    'SELECT * FROM food_category WHERE deleted=0 ';

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {

                                        $category_name = $row['category_name'];
                                        $category_id = $row['id'];
                                        ?> 
                                        <option <?php if (
                                            $current_category == $category_id
                                        ) {
                                            echo 'selected';
                                        } ?> value= "<?php echo $category_id; ?>"> <?php echo $category_name; ?></option>
                                       <?php
                                    }
                                } else {
                                     ?>
                                        <option value="0">No active category</option>
                                    <?php
                                }
                                ?>

                             
                                
                            </select>
                        </td>

                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                        <input <?php if ($featured == 'Yes') {
                            echo 'checked';
                        } ?> type="radio" name="featured" value ="Yes">Yes

                        <input <?php if ($featured == 'No') {
                            echo 'checked';
                        } ?> type="radio" name="featured" value ="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>With Vat?:</td>
                        <td>
                        <input <?php if ($vat == 1) {
                            echo 'checked';
                        } ?> type="radio" name="vat" value ="1">Yes

                        <input <?php if ($vat == 0) {
                            echo 'checked';
                        } ?> type="radio" name="vat" value ="0">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type= "hidden" name= "current_image" value= "<?php echo $current_image; ?>" >
                            <input type= "hidden" name= "id" value= "<?php echo $id; ?>" >
                            <input type= "submit" name= "submit" value= "Update" class= "btn">
                        </td>
                    </tr>
                </table>
           </form>
    
                  <?php if (isset($_POST['submit'])) {
                      $id = $_POST['id'];
                      $food_name = $_POST['food_name'];
                      $description = $_POST['description'];
                      $size = $_POST['size'];
                      $stocks = $_POST['stocks'];
                      $price = $_POST['price'];
                      $current_image = $_POST['current_image'];
                      $category = $_POST['category'];
                      $featured = $_POST['featured'];
                      $vat =  $_POST['vat'];

                      if (isset($_FILES['image']['name'])) {
                          $image_name = $_FILES['image']['name'];

                          if ($image_name != '') {
                              $ext = end(explode('.', $image_name));

                              $image_name =
                                  'Food_' . rand(0000, 9999) . '.' . $ext;

                              $source_path = $_FILES['image']['tmp_name'];
                              $destination_path =
                                  '../images/foods/' . $image_name;

                              $upload = move_uploaded_file(
                                  $source_path,
                                  $destination_path
                              );

                              if ($upload == false) {
                                  echo "<script>window.location.href='managefood.php?fail=1'</script>";

                                  die();
                              }

                              if ($current_image != '') {
                                  $remove_path =
                                      '../images/foods/' . $current_image;

                                  $remove = unlink($remove_path);

                                  if ($remove == false) {
                                      echo "<script>window.location.href='managefood.php?fail=1'</script>";

                                      die();
                                  }
                              }
                          } else {
                              $image_name = $current_image;
                          }
                      } else {
                          $image_name = $current_image;
                      }

                      $sql3 = "UPDATE tbl_food SET
                            food_name = '$food_name',
                            description = '$description',
                            size = '$size',
                            stocks = $stocks,
                            price = $price,
                            date_created=NOW(),
                            image_name = '$image_name',
                            category_id = '$category',
                            featured = '$featured',
                            withvat = '$vat'
                            WHERE id=$id
                            ";

                      $res3 = mysqli_query($conn, $sql3);

                      if ($res3 == true) {
                          echo "<script>window.location.href='managefood.php?success=1'</script>";
                      } else {
                          echo "<script>window.location.href='managefood.php?fail2=1'</script>";
                      }
                  } ?>
           

                
        </div>
</div>
            