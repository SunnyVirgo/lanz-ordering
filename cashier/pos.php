<?php
include 'cashiernav.php'; ?>
<div class="wrapper">
    <div class="cont">
<?php if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $sql = "SELECT * FROM orders WHERE id=$order_id";

    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $table = $row['table'];
        $name = $row['name'];
        $date = $row['date'];
    }
} ?>
        <div class="order">
                <div class="head">
                    <span>Table 0<?php echo $table; ?></span>
                    <span><?php echo $name; ?></span>
                     <span><?php if ($row['type'] == 'in') {
                         echo 'Dine-In';
                     } else {
                         echo 'Take-Out';
                     } ?></span>
                    <span><?php echo $date; ?></span>
                </div>
            <div class="order-table-box1">
                    <table class="order-tbl">
                        <colgroup>
                            <col width="40%">
                            <col width="13%">
                            <col width="12%">
                            <col width="10%">
                            <col width="15%">
                            <col width="10%">
                        </colgroup>
                        
                                                    <thead>
                                                        <th>Food Name</th>
                                                        <th>Size</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                        <th>Remove</th>
                                                    </thead>
                                                    <tbody>
                                                          <?php
                                                          $sql1 = "SELECT m.*, c.food_name as `food_name`, c.price as `price`, c.size as `size` from `order_details` m inner join tbl_food c on m.food_id = c.id where m.order_id = '$order_id'";
                                                          #$sql1="SELECT * FROM order_details WHERE order_id = $order_id";
                                                          $res1 = mysqli_query(
                                                              $conn,
                                                              $sql1
                                                          );
                                                          $count1 = mysqli_num_rows(
                                                              $res1
                                                          );
                                                          if ($count1 > 0) {
                                                              while (
                                                                  $row1 = mysqli_fetch_assoc(
                                                                      $res1
                                                                  )
                                                              ) { ?>
                                                             
                                                    <tr>
                                                    <td><?php echo $row1[
                                                        'food_name'
                                                    ]; ?></td>
                                                    <td><?php echo $row1[
                                                        'size'
                                                    ]; ?></td>
                                                    <td><?php echo number_format(
                                                        $row1['price'],
                                                        2
                                                    ); ?></td>
                                                     <form action="" method="POST">
                                                    <td>  <input type="hidden" name="current" value="<?php echo $row1[
                                                        'qnty'
                                                    ]; ?>" > <input type="hidden" name="food_id" value="<?php echo $row1['food_id'];?>">
                                                    <input type="number" name="qnty" class="qnty" value="<?php echo $row1[
                                                        'qnty'
                                                    ]; ?>">
                                                     <input type="hidden" name="price" value="<?php echo $row1[
                                                        'price'
                                                    ]; ?>" >
                                                    <input type="hidden" name="updateqnty"></td>
                                                       </form>
                                            
                                                    <td><?php echo number_format(
                                                        $row1['total_price'],
                                                        2
                                                    ); ?></td>
                                                    <td>
                                                   
                                                       <a class="cancel" href="remove_item.php?id=<?php echo $row1['food_id'] ;?>&orderId=<?php echo $order_id ;?>&qnty=<?php echo $row1[
                                                        'qnty'
                                                    ]; ?>"><i class='fa-solid fa-trash' data-placement="top" 
                                                        title="Remove"></i></a>
                                                   
                                  
                                                    </td>
                                                </tr>
                                             
                                                    <?php }
                                                          }
                                                          ?>     
                                                    </tbody>
                    </table>
                    <?php if (isset($_GET['page2'])): ?>
                    <div class="flash-data" data-flashdata="<? = $_GET['page2']; ?>"></div>
                <?php endif; ?>
          
                                                
            </div>
                <div class="amount">
                    <span>Total Amount</span>
                    <?php
                    $sql2 = "SELECT SUM(total_price)  AS sum from order_details WHERE order_id=$order_id";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    if ($count2 > 0) {
                        while ($row2 = mysqli_fetch_assoc($res2)){
                            $total = $row2['sum']; ?>
                        <span>₱ <?php echo number_format($total, 2); ?></span>
                        <?php
                        }
                    }
                    ?>
                    
                </div>
        </div>

        <div class="calc">
           <div class="order-amount">
            <div class="title-of-input">
                <span>Total Amount</span><br><br><br>
                <span>Tendered Amount</span><br><br><br>
                <span>Change</span>
            </div>
            <div class="title-input">
                <span><h2>₱ <?php echo number_format(
                    $total,
                    2
                ); ?></h2></span><br><br>
               <form action="" method="POST"><span><input type="number" class="cash" value="<?php if (
                   isset($_POST['tendered'])
               ) {
                   echo $_POST['tendered'];
               } ?>" name="tendered" step="any"></span><br><br>
            <input type="hidden" name="submit">
            </form> 
                  <?php
                  $tendered = 0;
                  if (isset($_POST['submit'])) {
                      if ($_POST['tendered'] < $total) {
                          echo "<script>
                            Swal.fire({
                            type: 'error',
                            title: 'Cash is lower than total amount!',
                            timer:2000,
                            showConfirmButton:false
                        }).then(function() {
                            window.location = 'pos.php?id=$order_id';
                         })

                    </script>";
                      } else {

                          $tendered = $_POST['tendered'];
                          $change = $tendered - $total;
                          ?>
                         <span><h2>₱ <?php echo number_format(
                             $change,
                             2
                         ); ?></h2></span>
            </div>
        </div>
         <form action="" method="POST">
        <div class="submit">
            <input type="hidden" name="ttl" value="<?php echo $total; ?>">
             <input type="hidden" name="tendered" value="<?php echo $tendered; ?>">
             <input type="hidden" name="change" value="<?php echo $change; ?>">
        <button name="place" class="place">Place Order</button>
        </div>
         </form>
                 <?php
                      }
                  }
                  ?>
                     
         <?php if (isset($_POST['place'])) {
             if ($_POST['change'] < 0) {
                 echo "<script>
                            Swal.fire({
                            type: 'error',
                            title: 'Cash is lower than total amount!',
                            timer:2000,
                            showConfirmButton:false
                        }).then(function() {
                            window.location = 'pos.php?id=$order_id';
                         })

                    </script>";
             } else {
                 $transaction_code = 0;
                 $code = date('Ymd');
                 $ext = '00';
                 $user = $rows['user_name'];
                 $total1 = $_POST['ttl'];
                 $tendered1 = $_POST['tendered'];
                 $change1 = $_POST['change'];

                 $sql3 = "UPDATE orders SET tcode='$code$ext$transaction_code',
                                            cashier='$user',
                                         total_amount='$total1',
                                         tendered_amount='$tendered1',  
                                         change_amount=$change1,
                                         status=1,
                                         update_time=NOW() where 
                                         id='$order_id' ";
                 $res3 = mysqli_query($conn, $sql3);
                 $date = date('Y-m-d');
                 $sql = "SELECT MAX(tcode) as 'highest' FROM  orders WHERE date='$date'";
                 $res = mysqli_query($conn, $sql);
                 $row = mysqli_fetch_assoc($res);

                 $tcode = $row['highest'];
                 $sql = "SELECT tcode FROM  orders WHERE date='$date' AND tcode='$tcode'";
                 $res = mysqli_query($conn, $sql);
                 $count = mysqli_num_rows($res);
                 if ($count > 0) {
                     $transaction_code1 = $tcode + 1;
                     $sqlMaxReceipt = "SELECT MAX(receipt) AS maxReceipt FROM orders";
                     $resultMaxReceipt = mysqli_query($conn, $sqlMaxReceipt);
                     $rowMaxReceipt = mysqli_fetch_assoc($resultMaxReceipt);
                     $nextReceipt = $rowMaxReceipt['maxReceipt'] + 1;
                     $sql4 = "UPDATE orders SET tcode='$transaction_code1', receipt = $nextReceipt
                                             where
                                          id='$order_id' ";
                     $res4 = mysqli_query($conn, $sql4);
                     if ($res4 == true) {
                         echo "<script>
                             Swal.fire({
                             type: 'success',
                             title: 'Transaction Success!',
                             timer:2000,
                             showConfirmButton:false
                         }).then(function() {
                             window.location ='receipt.php?id=$order_id';
                          })

                     </script>";
                     }
                 }
             }
         


}

if(isset($_POST['updateqnty']))
{
    $id3=$_POST['food_id'];
    $price = $_POST['price'];
    $query1 = "SELECT stocks FROM tbl_food WHERE id =  '$id3'";
    $query1_result = mysqli_query($conn, $query1);
    $rows = mysqli_fetch_assoc($query1_result);

    $current_qnty = $_POST['current'];
    $new_qnty = $_POST['qnty'];
    $stocks = $new_qnty - $current_qnty;
    $new_stock = $rows['stocks'] - $stocks;
    if($rows['stocks'] >= $stocks)
    {
        $query2 = "UPDATE tbl_food SET stocks = stocks - '$stocks' WHERE id = '$id3'";
        mysqli_query($conn, $query2);
        $query="UPDATE order_details SET qnty = '$new_qnty', total_price = $price * $new_qnty WHERE order_id= '$order_id' AND food_id = '$id3'";
        $result=mysqli_query($conn, $query);
        if($result)
        {
            echo "<script>
            Swal.fire({
            type: 'success',
            title: 'Item updated!',
            timer:2000,
            showConfirmButton:false
        }).then(function() {
            window.location ='pos.php?id=$order_id';
         })
    
    </script>";
        }
    }
  else 
  {
    echo "<script> Swal.fire({
        type: 'error',
        confirmButtonColor: ' blue',
        text: 'Not enough stocks',
        timer:2000,
        showConfirmButton:false
    }).then(function() {
  
        window.location ='pos.php?id=$order_id';
    })
    </script>";
  }
}



         ?>
    </div>
</div>
<script src="../adminpanel/toggle.js">
</script>

<script>

$('.cancel').on('click', function(s) {
        s.preventDefault();
        const a = $(this).attr('href')

        Swal.fire({
            title: 'Are You Sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText:'Yes',
        }).then((result) => {
            if (result.value) {
                document.location.href = a;
            }
        })
    });


   
  </script>

