<?php include 'parts/menu2.php'; ?>
       
     
            
          
        <div class ="wrapper" id="wrapper">
         
   <?php
   $sql = 'SELECT * FROM settings';
   $res = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($res);

   $current_image = $row['logo'];
   ?>
     <div class="system-settings">
        <form action=""  method="POST" enctype="multipart/form-data">
            
               <label for="">Current Logo: </label>
                <?php if ($current_image == '') {
                    echo "<div class= 'no1'>Image not added</div>";
                } else {
                     ?>
                                    <img src = "../images/foods/<?php echo $current_image; ?>" width ="150px" height="100px">
                                    <?php
                } ?><br><br>
                <label>System Logo: </label><input type="file" name="image">
                   <label>Name:</label><input type="text" name="sname" value="<?php echo $row[
                       'name'
                   ]; ?>">
               <label> Qoute: </label><textarea rows="10" name="qoute"><?php echo $row[
                   'qoute'
               ]; ?></textarea>
               <label>Client's Address: </label><input type="address" name="address" value="<?php echo $row[
                   'address'
               ]; ?>">
               <label>Client's Contact: </label><input type="tel" name="contact" value="<?php echo $row[
                   'contact'
               ]; ?>">
               <label for="">Email: </label>
               <input type="email" name="email" value="<?php echo $row[
                   'email'
               ]; ?>">
               <label for="">Vat Percentage: </label>
               <input type="number" name="vat" value="<?php echo $row[
                   'vat_percentage'
               ]; ?>">
            <br><br>
                <input type= "hidden" name= "current_image" value= "<?php echo $current_image; ?>" >
               <button name="save">Save Changes</button>

               </form>
               <?php if (isset($_POST['save'])) {
                   if (isset($_FILES['image']['name'])) {
                       $image_name = $_FILES['image']['name'];

                       if ($image_name != '') {
                        $filename_parts = explode('.', $image_name);
                        $ext = end($filename_parts);

                           $image_name =
                               'Logo_' . rand(0000, 9999) . '.' . $ext;

                           $source_path = $_FILES['image']['tmp_name'];
                           $destination_path = '../images/foods/' . $image_name;

                           $upload = move_uploaded_file(
                               $source_path,
                               $destination_path
                           );

                           if ($upload == false) {
                               die();
                           }

                           if ($current_image != '') {
                               $remove_path =
                                   '../images/foods/' . $current_image;

                               $remove = unlink($remove_path);

                               if ($remove == false) {
                                   die();
                               }
                           }
                       } else {
                           $image_name = $current_image;
                       }
                   } else {
                       $image_name = $current_image;
                   }

                   $sql3 = "UPDATE settings SET
                            name = '$_POST[sname]',
                            qoute = '$_POST[qoute]',
                            logo = '$image_name',
                            contact = '$_POST[contact]',
                            address = '$_POST[address]',
                            email = '$_POST[email]',
                            vat_percentage = '$_POST[vat]'
                            WHERE id=1
                            ";

                   $res3 = mysqli_query($conn, $sql3);

                   if ($res3 == true) {
                       echo "<script>  Swal.fire({
                            type: 'success',
                            title: 'Settings Updated!',
                            timer:2000,
                            showConfirmButton:false
                        }).then(function() {
                            window.location = 'settings.php';
                         })</script>";
                   } else {
                       echo "<script>  Swal.fire({
                            type: 'error',
                            title: 'Update Failed!',
                            timer:2000,
                            showConfirmButton:false
                        }).then(function() {
                            window.location = 'settings.php';
                         })</script>";
                   }
               } ?>
        </div>    
                  
    </div>
   
   
    <script src="toggle.js"></script>