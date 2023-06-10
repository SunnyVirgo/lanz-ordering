<?php
 include '../config/constant.php';

 if (isset($_GET['id'])) {
     $id1 = $_GET['id'];

     $query = "SELECT * FROM order_details WHERE order_id = $id1";
     $result = mysqli_query($conn, $query);

     while ($row = mysqli_fetch_assoc($result)) {
         $food_id = $row['food_id'];
         $quantity = $row['qnty'];

         // Update stock quantity in the products table
         $update_query = "UPDATE tbl_food SET stocks = stocks + $quantity WHERE id = $food_id";
         mysqli_query($conn, $update_query);
     }

     $sql2 = "DELETE FROM orders where id='$id1'";
     $res2 = mysqli_query($conn, $sql2);
     if ($res2 == true) {
         header('location:index.php?page2=1');
     } else {
     }
 }


?>