
                   

<?php include 'managecategory.php'; ?>
            
                              
    <div class="login1">
    <div class="login-content">
        
       <form action="" method="POST" enctype="multipart/form-data">
        <div class ="close">
                <a href="managecategory.php"><i class='fa-solid fa-xmark'></i></a>
                </div>
                <table class="table">
                    <tr>
                        <td>Name</td>
                   
                        <td><input type="text" name="category_name" placeholder="Category name" class="input" required></td>
                    </tr>
                
                    <tr>
                        <td colspan="2">
                            <input type= "submit" name= "submit" value= "Submit" class= "btn">
                        </td>
                    </tr>
                </table>
           </form>
    
            
            
           

                <?php if (isset($_POST['submit'])) {
                    $category_name = $_POST['category_name'];

                    $sql = "INSERT INTO food_category SET
                    category_name='$category_name'
                    ";

                    $res = mysqli_query($conn, $sql);

                    if ($res == true) {
                        echo "<script>window.location.href='managecategory.php?success1=1'</script>";
                    } else {
                        echo "<script>window.location.href='managecategory.php?fail3=1'</script>";
                    }
                } ?>

        </div>
</div>
             