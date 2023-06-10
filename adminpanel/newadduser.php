<?php include 'newmanage.php'; ?>
            
                               
    <div class="login1">
    <div class="login-content1">
        
       <form action="" method="POST">
        <div class ="close">
                <a href="newmanage.php"><i class='fa-solid fa-xmark'></i></a>
                </div>
                <table class="table1">
                    <tr>
                        <td>Full Name:</td>
                   
                        <td><input type="text" name="full_name" placeholder="Enter Your Full Name" value="<?php if (
                            isset($_POST['full_name'])
                        ) {
                            echo $_POST['full_name'];
                        } ?>" class="input" required></td>
                    </tr>

                    <tr>
                        <td>User Name:</td>
                        <td><input type="text" name="user_name" placeholder="Enter Your User Name" class="input" value="<?php if (
                            isset($_POST['user_name'])
                        ) {
                            echo $_POST['user_name'];
                        } ?>" required></td>
                    </tr>

                    
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" id="pass" placeholder="Enter Your Password" class="input" id="input" value="<?php if (
                            isset($_POST['password'])
                        ) {
                            echo $_POST['password'];
                        } ?>" required></td>
                        <td>
                    
                    </tr>

                    <tr>
                        <td>Confirm Password:</td>
                        <td><input type="password" name="cpassword" placeholder="Confirm Password" class="input" id="input1" value="<?php if (
                            isset($_POST['cpassword'])
                        ) {
                            echo $_POST['cpassword'];
                        } ?>" required></td>
                        <td>
                   </td>
                    </tr>
                    <tr>
                        <td>User Type:</td>
                        <td>
                        <select type="name" name="user_type" value="<?php if (
                            isset($_POST['user_type'])
                        ) {
                            echo $_POST['user_type'];
                        } ?>" required>
                        <option value=""disabled selection>Select User Type</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Kitchen Staff">Kitchen Staff</option>
                        <option value="Kiosk">Kiosk</option>
                        </select>
                    </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type= "submit" name= "submit" value= "Submit" class= "btn">
                        </td>
                    </tr>
                </table>
           </form>
    
            
            
<?php if (isset($_POST['submit'])) {
    //get data from form
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $user_type = $_POST['user_type'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $usernameCheck=mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_name = '$user_name'");
    $usernameCount = mysqli_num_rows($usernameCheck);
    if($usernameCount == 0 )
    {
        $sql1 = "SELECT user_name FROM tbl_users WHERE user_name = '$user_name'";
        $res1 = mysqli_query($conn, $sql1);
        $count = mysqli_num_rows($res1);
    
        if ($count > 0) {
            echo "<script> Swal.fire({
                type: 'error',
                title: 'Oppps!',
                confirmButtonColor: ' blue',
                text: 'Username already exist!',
                timer:3000,
                showConfirmButton:false
            })</script>";
        }
        //query to save to database
        elseif ($password === $cpassword) {
            $sql = "INSERT INTO tbl_users(full_name, user_name, password, user_type) 
                        VALUES ('{$full_name}', '{$user_name}', '{$password}', '{$user_type}')";
    
            echo "<script>window.location.href='newmanage.php?success=1' </script>";
        } else {
            echo "<script> Swal.fire({
                type: 'error',
                title: 'Oppps!',
                confirmButtonColor: ' blue',
                text: 'Password did not match!',
                timer:3000,
                showConfirmButton:false
            })
            </script>";
        }
    
        ($res = mysqli_query($conn, $sql)) or die(mysqli_error());
    
        if ($res != true) {
            echo "<script>window.location.href='newadduser.php?fail4=1'</script>";
        } else {
        }
    }
    else
    {
        echo "<script> Swal.fire({
            type: 'error',
            title: 'Oppps!',
            confirmButtonColor: ' blue',
            text: 'Username already exist!',
            timer:3000,
            showConfirmButton:false
        })
        </script>";
    }
  
} ?>




        </div>
</div>
         <script>

var newPasswordInput = document.getElementById('pass');



newPasswordInput.addEventListener('input', function() {
  var password = newPasswordInput.value.trim();
  if (password.length >= 8) {
    newPasswordInput.setCustomValidity('');
  } else {
    newPasswordInput.setCustomValidity('Password must be at least 8 characters long.');
  }
});
         </script>