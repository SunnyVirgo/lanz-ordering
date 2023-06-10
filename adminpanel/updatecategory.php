
                   

<?php include 'managecategory.php'; ?>
            
                            
    <div class="login1">
    <div class="login-content">

            <?php if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM food_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $category_name = $row['category_name'];
                } else {
                    echo "<script>window.location.href='managecategory.php?not-found=1'</script>";
                }
            } else {
                echo "<script>window.location.href='managecategory.php'</script>";
            } ?>
        
       <form action="" method="POST" enctype="multipart/form-data">
        <div class ="close3">
                <a href="managecategory.php"><i class='fa-solid fa-xmark'></i></a>
                </div>
                <table class="table">
                    <tr>
                        <td>Name:</td>
                   
                        <td><input type="text" name="category_name" value= "<?php echo $category_name; ?>" class="input"></td>
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
                            $category_name = $_POST['category_name'];

                            $sql2 = "UPDATE food_category SET
                                        category_name = '$category_name'
                                        WHERE id=$id
                                        ";

                            $res2 = mysqli_query($conn, $sql2);

                            if ($res2 == true) {
                                echo "<script>window.location.href='managecategory.php?success=1'</script>";
                            } else {
                                echo "<script>window.location.href='managecategory.php?fail2=1'</script>";
                            }
                        } ?>
            
           

                
        </div>
</div>
            