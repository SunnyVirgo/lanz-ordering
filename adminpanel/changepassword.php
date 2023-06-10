<?php include 'newmanage.php'; ?>


        <div class ="login1">
            <div class ="login-content">
                
                <br><br><br>

                <?php if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                } ?>

                <form action="" method="POST">
                    <div class ="close" id="close">
                <a href="newmanage.php"><i class='fa-solid fa-xmark'></i></a>
                </div>
                <table class="table">
                    <tr>
                        <td>Current Password</td>
                        <td>
                            <input type = "password" name = "current_password" placeholder = "Enter Current Password" class="input" id= "input2" value="<?php if (
                                isset($_POST['current_password'])
                            ) {
                                echo $_POST['current_password'];
                            } ?>" required>
                        </td>
                         <td>
                        
                    </tr>

                    <tr>
                        <td> New Password</td>
                        <td>
                            <input type = "password" name = "new_password" placeholder = "Enter New Password" class="input" id ="input" value="<?php if (
                                isset($_POST['new_password'])
                            ) {
                                echo $_POST['new_password'];
                            } ?>" required >
                        </td>
                          <td>
                       
                    </tr>

                        <tr>
                        <td> Confirm Password</td>
                        <td>
                            <input type = "password" name = "confirm_password" placeholder = "Confirm Password" class="input" id="input1" value="<?php if (
                                isset($_POST['confirm_password'])
                            ) {
                                echo $_POST['confirm_password'];
                            } ?>" required>
                        </td>
                        <td>
                        
                    </tr>

                        <tr>
                        <td colspan = "2">
                            <input type ="hidden" name ="id" value = "<?php echo $id; ?>">
                            <input type = "submit" name ="submit" value = "Submit" class = "btn">

                        </td>
                    </tr>

                    
                </table>
            </form>

            </div>
        </div>

        <?php if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            $sql = "SELECT * FROM tbl_users WHERE id=$id AND password= '$current_password' ";

            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    if ($new_password == $confirm_password) {
                        $sql2 = "UPDATE tbl_users SET
                                    password = '$new_password'
                                    WHERE id = $id
                                    ";

                        $res2 = mysqli_query($conn, $sql2);

                        if ($res2 == true) {
                            echo "<script>window.location.href='newmanage.php?m=1'</script>";
                        } else {
                            echo "<script>  Swal.fire({
                                                type: 'error',
                                                title: 'Oppps!',
                                                confirmButtonColor: ' blue',
                                                text: 'User not found!',
                                                timer:3000,
                                                showConfirmButton:false
                                                 })</script>";
                        }
                    } else {
                        echo "<script> Swal.fire({
                                            type: 'error',
                                            title: 'Oppps!',
                                            confirmButtonColor: ' blue',
                                            text: 'Password did not match!',
                                            timer:3000,
                                            showConfirmButton:false
                                             })</script>";
                    }
                } else {
                    echo "<script> Swal.fire({
                                type: 'error',
                                title: 'Oppps!',
                                confirmButtonColor: ' blue',
                                text: 'Current password is incorrect!',
                                timer:3000,
                                showConfirmButton:false
                                })</script>";
                }
            }
        } ?>

 