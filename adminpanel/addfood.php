
                   

<?php include 'managefood.php'; ?>
            
                              
    <div class="login1">
    <div class="login-content1">
        
       <form action="" method="POST" enctype="multipart/form-data">
        <div class ="close3">
                <a href="managefood.php"><i class='fa-solid fa-xmark'></i></a>
                </div>
                <table class="table1">
                    <tr>
                        <td>Name</td>
                   
                        <td><input type="text" name="food_name" placeholder="Food name" class="input" required></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Description</td>
                   
                        <td><textarea name="description" cols="30" rows="5" placeholder="Food description"></textarea></td>
                    </tr>
                    <tr>
                        <td>Size</td>
                   
                        <td><input type="text" name="size" class="input" required></td>
                    </tr>

                    <tr>
                        <td>Price</td>
                   
                        <td><input type="number" name="price" class="input" min="1" max="9999" step="any" required></td>
                    </tr>
                    <tr>
                        <td>Servings</td>
                   
                        <td><input type="number" name="stocks" class="input" required></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Select Image</td>
                        <td><input type="file" name= "image"></td>

                    </tr>

                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">

                            <?php
                            $sql =
                                'SELECT * FROM food_category WHERE deleted=0';

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {

                                    $id = $row['id'];
                                    $category_name = $row['category_name'];
                                    ?>
                                        <option value= "<?php echo $id; ?>"><?php echo $category_name; ?></option>
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
                        <td>Featured</td>
                        <td><input type="radio" name="featured" value ="Yes" class="radio">Yes
                        <input type="radio" name="featured" value ="No" class="radio">No
                        </td>
                        </tr>
                        <tr>
                        <td>With VAT?</td>
                        <td><input type="radio" name="vat" value="1" class="radio">Yes
                        <input type="radio" name="vat" value="0" class="radio">No
                        </td>
                        </tr>
                    <tr>
                        <td colspan="2">
                            <input type= "submit" name= "submit" value= "Add Food" class= "btn">
                        </td>
                    </tr>
                </table>
           </form>
    
            
            <?php if (isset($_POST['submit'])) {
                $food_name = $_POST['food_name'];
                $description = $_POST['description'];
                $size = $_POST['size'];
                $stocks = $_POST['stocks'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $vat = $_POST['vat'];
                $vat1 = intval($vat);

                if (isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = 'No';
                }
                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    if ($image_name != '') {
                        $ext = end(explode('.', $image_name));

                        $image_name = 'Food_' . rand(0000, 9999) . '.' . $ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = '../images/foods/' . $image_name;

                        $upload = move_uploaded_file(
                            $source_path,
                            $destination_path
                        );

                        if ($upload == false) {
                            echo "<script>window.location.href='managefood.php?fail1=1'</script>";

                            die();
                        }
                    }
                } else {
                    $image_name = '';
                }

                $sql2 = "INSERT INTO tbl_food SET
                        food_name = '$food_name',
                        description = '$description',
                        size = '$size',
                        stocks = $stocks,
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        withvat = '$vat1'
                        ";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    echo "<script>window.location.href='managefood.php?success1=1'</script>";
                } else {
                    echo "<script>window.location.href='managefood.php?fail3=1'</script>";
                }
            } ?>
           

                
        </div>
</div>
            