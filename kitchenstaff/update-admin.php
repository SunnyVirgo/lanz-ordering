<?php include 'index.php'; ?>


<!-- for update admin -->
 
     <div class ="login1" id="login3">
         <div class ="login-content1">
            
             
             <br><br><br>

         
  <?php
  //get the user ID
if(isset($_GET['id']))
{
 $id=$_GET['id'];
}
  //CREATE SQL QUERY TO GET DETAILS
  $sql5 = "SELECT * FROM tbl_users WHERE id = $id";

  //execute the query
  $res5 = mysqli_query($conn, $sql5);

  // checking
  if ($res5 == true) {
      $count5 = mysqli_num_rows($res5);

      if ($count5 == 1) {
          //get details
          $row5 = mysqli_fetch_assoc($res5);

          $full_name5 = $row5['full_name'];
          $user_name5 = $row5['user_name'];
          $password = $row5['password'];
      } else {
      }
  }
  ?>

             <form action="" method="POST">
                 <div class ="close3" id="close">
             <a href="index.php"><i class='fa-solid fa-xmark'></i></a>
             </div>
              <h3 class="admin-settings">Update Account</h3>
             <table class="table">
                 <tr>
                      <td>Username</td>
                     <td>
                         <input type="text" name="user_name" value ="<?php if (
                         isset($_POST['user_name'])
                     ) {
                         echo $_POST['user_name'];
                     }
                     else echo $user_name5; ?>" class="input">
                     </td>
             
                 </tr>
                 <tr>
                     <td>Current Password</td>
                     <td>
                         <input type = "password" id="current-password" name = "current_password" placeholder = "Enter Current Password" class="input" id= "input6" x>
                     </td>
                      <td>
                    

                 </tr>

                 <tr id="new-password-group" style="display: none;">
                     <td> New Password</td>
                     <td>
                         <input type = "password" id="new-password" name = "new_password" placeholder = "Enter New Password" class="input" id ="input4" >
                     </td>
                       <td>
                    
                 </tr>

                     <tr id = "confirm-password-group" style="display: none;">
                     <td> Confirm Password</td>
                     <td>
                         <input type = "password" id="confirm-password" name = "confirm_password" placeholder = "Confirm Password" class="input" id="input5">
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
<?php if (isset($_POST['submit'])) {
   $user_name6 = $_POST['user_name'];
   $usernameCheck=mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_name = '$user_name6' and id != $id");
   $usernameCount = mysqli_num_rows($usernameCheck);
   if($usernameCount == 0 )
   {
    if ($_POST['current_password'] == '') {
        $current_password6 = $password;
        $new_password6 = $password;
        $confirm_password6 = $password;
    } else {
        $current_password6 = md5($_POST['current_password']);
        $new_password6 = md5($_POST['new_password']);
        $confirm_password6 = md5($_POST['confirm_password']);
    }
 
    $sql6 = "SELECT * FROM tbl_users WHERE id = $id AND password= '$current_password6' ";
 
    $res6 = mysqli_query($conn, $sql6);
 
    if ($res6 == true) {
        $count6 = mysqli_num_rows($res6);
 
        if ($count6 == 1) {
            if ($new_password6 == $confirm_password6) {
                $sql7 = "UPDATE tbl_users SET
                                  user_name = '$user_name6',
                                  password = '$new_password6'
                                  WHERE id=$id
                                  ";
 
                $res7 = mysqli_query($conn, $sql7);
 
                if ($res7 == true) {
                 echo "<script> Swal.fire({
                     type: 'success',
                     title: 'Success!',
                     confirmButtonColor: ' blue',
                     text: 'Account updated!',
                      timer:3000,
                     showConfirmButton:false
                 
                 }).then(function() {
                     window.location = 'index.php';
                 })
                 </script>";
                } else {
                }
            } else {
                echo "<script> Swal.fire({
                  type: 'error',
                  title: 'Error!',
                  confirmButtonColor: ' blue',
                  text: 'Password did not match!',
                   timer:3000,
                  showConfirmButton:false
              
              })
              </script>";
            }
        } else {
            echo "<script> Swal.fire({
              type: 'error',
              title: 'Error!',
              confirmButtonColor: ' blue',
              text: 'Password is incorrect!',
               timer:3000,
              showConfirmButton:false
          
          })
          </script>";
        }
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

   
}

?>
<script>
var currentPasswordInput = document.getElementById('current-password');
var newPasswordGroup = document.getElementById('new-password-group');
var confirmPasswordGroup = document.getElementById('confirm-password-group');
var newPasswordInput = document.getElementById('new-password');
var confirmPasswordInput = document.getElementById('confirm-password');

currentPasswordInput.addEventListener('input', function() {
if (currentPasswordInput.value.trim() !== '') {
 newPasswordGroup.style.display = 'table-row';
 confirmPasswordGroup.style.display = 'table-row';
 newPasswordInput.setAttribute('required', 'required');
 confirmPasswordInput.setAttribute('required', 'required');
} else {
 newPasswordGroup.style.display = 'none';
 confirmPasswordGroup.style.display = 'none';
 newPasswordInput.removeAttribute('required');
 confirmPasswordInput.removeAttribute('required');
}
});
newPasswordInput.addEventListener('input', function() {
  var password = newPasswordInput.value.trim();
  if (password.length >= 8) {
    newPasswordInput.setCustomValidity('');
  } else {
    newPasswordInput.setCustomValidity('Password must be at least 8 characters long.');
  }
});
</script>