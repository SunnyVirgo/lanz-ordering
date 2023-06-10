

 <?php
 include '../config/constant.php';

 if (isset($_GET['id'])) {
     $id = $_GET['id'];

     $sql = "UPDATE tbl_users SET deleted=1 WHERE id=$id";

     $res = mysqli_query($conn, $sql);

     if ($res == true) {
         echo "<script>window.location.href='newmanage.php?n=1'</script>";
     } else {
         echo "<script>window.location.href='newmanage.php?fails=1'</script>";
     }
 }

 if (isset($_GET['id1'])) {
     $id1 = $_GET['id1'];

     $sql = "UPDATE tbl_users SET deleted=0 WHERE id=$id1";

     $res = mysqli_query($conn, $sql);

     if ($res == true) {
         echo "<script>window.location.href='newmanage.php?n=1'</script>";
     } else {
         echo "<script>window.location.href='newmanage.php?fails=1'</script>";
     }
 }


?>
