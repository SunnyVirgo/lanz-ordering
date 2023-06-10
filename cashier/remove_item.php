
<?php
include '../config/constant.php'; 
if(isset($_GET['id']) && isset($_GET['orderId'])&& isset($_GET['qnty'])){
$qnty=$_GET['qnty'];
  $id3=$_GET['id'];
  $order_id=$_GET['orderId'];
    $query="DELETE FROM order_details WHERE order_id= '$order_id' AND food_id = '$id3'";
    $result=mysqli_query($conn, $query);
    if($result)
    {
      $query2 = "UPDATE tbl_food set stocks = stocks + '$qnty' where id= '$id3'";
      mysqli_query($conn, $query2);
   
        echo "<script>
      
        window.location ='pos.php?id=$order_id';

</script>";


    }

 
}
 
?>



