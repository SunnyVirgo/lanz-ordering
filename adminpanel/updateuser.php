<?php include 'newmanage.php'; ?>

<div class="login1">
    <div class="login-content">
               
            <br><br>


            <?php if (isset($_GET['id'])) {
                //get the user ID
                $id = $_GET['id'];

                //CREATE SQL QUERY TO GET DETAILS
                $sql = "SELECT * FROM tbl_users WHERE id=$id";

                //execute the query
                $res = mysqli_query($conn, $sql);

                // checking
                if ($res == true) {
                    $count = mysqli_num_rows($res);

                    if ($count == 1) {
                        //get details
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $user_name = $row['user_name'];
                        $user_type = $row['user_type'];
                        $password = $row['password'];
                    } else {
                        //redirect tp manage admin
                        echo "<script> Swal.fire({
                            type: 'error',
                            title: 'Oppps!',
                            confirmButtonColor: ' blue',
                            text: 'User not found!',
                            timer:3000,
                            showConfirmButton:false
                            })</script>";
                    }
                }
            } ?>
            
            <form action="" method="POST">
                <div class ="close">
                <a href="newmanage.php"><i class='fa-solid fa-xmark'></i></a>
                </div>
                <table class = "table1">
                  

                    <tr>
                        <td>User Type:</td>
                        <td>
                        <select type="name" name="user_type" value ="<?php echo $user_type; ?>">
                        <option  value=""disabled selection>Select User Type</option>
                        <option <?php if ($user_type == 'Cashier') {
                            echo 'selected';
                        } ?> value="Cashier">Cashier</option>
                        <option <?php if ($user_type == 'Kitchen Staff') {
                            echo 'selected';
                        } ?> value="Kitchen Staff">Kitchen Staff</option>
                        <option <?php if ($user_type == 'Kiosk') {
                            echo 'selected';
                        } ?> value="Kiosk">Kiosk</option>
                        </select>
                    </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type = "hidden" name = "id" value ="<?php echo $id; ?>">
                            <input type= "submit" name= "submit" value= "Update" class= "btn">
                        </td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
         
        <?php if (isset($_POST['submit'])) {
            //get all the values from form

            $id = $_POST['id'];
       
            $user_type = $_POST['user_type'];
    

            //query to update user
   
                $sql = "UPDATE tbl_users SET 
                        user_type = '$user_type'
                        WHERE id = '$id'
                    ";

                //execute the query
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    echo "<script>window.location.href='newmanage.php?m=1'</script>";
                } else {
                    echo "<script>Swal.fire({
                            type: 'error',
                            title: 'Oppps!',
                            confirmButtonColor: ' blue',
                            text: 'Update failed!',
                            timer:3000,
                            showConfirmButton:false
                            })</script>";
                }
            }
         ?>

