<?php include 'order.php'; ?>

          <?php if (isset($_GET['id'])) {
              $id = $_GET['id'];

              $sql2 = "SELECT * FROM order_details WHERE order_id='$id'";
              $res2 = mysqli_query($conn, $sql2);

              $row2 = mysqli_fetch_assoc($res2);

              $food = $row2['food'];
              $price = $row2['price'];
              $qty = $row2['qty'];
          } ?>

<div class="login01" id="MyModal" tabindex="-1" role="dialog">
      
        <div class="login-content4">
                <div class="order-box">
                                    <div class="order-cont">
                                        <div class="order-header">
                                          <h1>Order Items</h1>
                                          <a href="order.php" class="cancel"> <button class = "modal-close"><i class="fa-solid fa-xmark"></i></button></a>
                                        </div>
                                        <div class="order-table-box">
                                        <table class="order-tbl">
                                            <colgroup>
                                     
                                        <col width="50%">
                                        <col width="30%">
                                        <col width="20%">
                                        </colgroup>
                                            <thead>
                                                <th>Food Name</th>
                                                <th>Size</th>
                                                <th>Qty</th>
                                            </thead>
                                            <tbody>
                                         <?php
                                         $sql1 = "SELECT m.*, c.food_name as `food_name`, c.price as `price`, c.size as `size` from `order_details` m inner join tbl_food c on m.food_id = c.id where m.order_id = '$id'";
                                         #$sql1="SELECT * FROM order_details WHERE order_id = $id";
                                         $res1 = mysqli_query($conn, $sql1);
                                         $count1 = mysqli_num_rows($res1);
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
                                                    <td><?php echo $row1[
                                                        'qnty'
                                                    ]; ?></td>
                                                </tr>
                                                    <?php }
                                         }
                                         ?>     
                                                
                                                    
                                            </tbody>
                                        </table>
                                    </div>
                                        <div class="btn-serve">
                                 
                                           
                                        </div>
                                        </div>
                                </div>
            </div>
              
        
    </div>   