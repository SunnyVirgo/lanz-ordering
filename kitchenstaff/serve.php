
   <?php
   include '../config/constant.php';

   if (isset($_GET['id'])) {
       $id1 = $_GET['id'];
       $user = $rows['user_name'];
       $sql2 = "UPDATE orders SET kitchen_staff='$user', status=2 where id='$id1'";
       $res2 = mysqli_query($conn, $sql2);
       if ($res2 == true) {
           header('location:index.php?m=1');
       } else {
       }
   }


?>
